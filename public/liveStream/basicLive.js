// create Agora client
var client = AgoraRTC.createClient({
    mode: "live",
    codec: "vp8"
});

var localTracks = {
    videoTrack: null,
    audioTrack: null
};

var remoteUsers = {};

// Agora client options
var options = {
    appid: "73360382719943c6a12d1602e673eb8f",
    channel: slug,
    uid: null, // Need Dynamic Id
    token: null,
    role: null, // host or audience
    audienceLatency: 2
};

$("#host-join").click(function (e) {
    options.role = "host"
})

$("#audience-join").click(function (e) {
    options.role = "audience";
    options.audienceLatency = 1;
    $("#join-form").click();
});

$("#join-form").click(async function (e) {
    e.preventDefault();
    $("#host-join").attr("disabled", true);
    $("#audience-join").attr("disabled", true);
    try {
        await join();
    } catch (error) {
        console.log(error);
    } finally {
        $("#leave").attr("disabled", false);
    }
})

$("#leave").click(function (e) {
    leave();
})

async function join() {

    // create Agora client
    if (options.role === "audience") {
        client.setClientRole(options.role, { level: options.audienceLatency });
        // add event listener to play remote tracks when remote user publishs.
        client.on("user-published", handleUserPublished);
        client.on("user-unpublished", handleUserUnpublished);
    }
    else {
        options.role = "host";
        client.setClientRole(options.role);
    }

    // join the channel
    options.uid = await client.join(options.appid, options.channel, options.token || null, options.uid || null);

    if (options.role === "host") {
        // create local audio and video tracks
        localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
        localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();

        // play local video track
        localTracks.videoTrack.play("local-player");
        $("#local-player-name").text(`localTrack(${options.uid})`);

        // stream token update
        streamTokenUpdate(streamId, options.uid);

        // stream channel slug
        console.log('Channel Slug: ' + options.channel);

        // publish local tracks to channel
        await client.publish(Object.values(localTracks));
        console.log("Host started streaming");

        // Store Channel name & user id in localStorage
        localStorage.setItem("cname", slug);
        localStorage.setItem("uid", options.uid);
    }
}

async function leave() {
    for (trackName in localTracks) {
        var track = localTracks[trackName];
        if (track) {
            track.stop();
            track.close();
            localTracks[trackName] = undefined;
        }
    }

    // remove remote users and player views
    remoteUsers = {};
    $("#remote-playerlist").html("");

    // Stop record function
    // alert("stopRecordingFun");
    // stopRecordingFun();

    // leave the channel
    await client.leave();

    $("#local-player-name").text("");
    $("#host-join").attr("disabled", false);
    $("#audience-join").attr("disabled", false);
    $("#leave").attr("disabled", true);
    console.log("client leaves channel success");
}

async function subscribe(user, mediaType) {
    const uid = user.uid;
    // subscribe to a remote user
    await client.subscribe(user, mediaType);
    console.log("subscribe success");
    if (mediaType === 'video') {
        const player = $(`
      <div id="player-wrapper-${uid}">
        <p class="player-name">remoteUser(${uid})</p>
        <div id="player-${uid}" class="player"></div>
      </div>
    `);
        $("#remote-playerlist").append(player);
        user.videoTrack.play(`player-${uid}`, { fit: "contain" });
    }
    if (mediaType === 'audio') {
        user.audioTrack.play();
    }

    localStorage.setItem("cname", slug);
    localStorage.setItem("uid", options.uid);
}

function handleUserPublished(user, mediaType) {
    console.log(`User is: ${user} MediaType is: ${mediaType}`);
    const id = user.uid;
    console.log(user);
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

function handleUserUnpublished(user, mediaType) {
    if (mediaType === 'video') {
        const id = user.uid;
        delete remoteUsers[id];
        $(`#player-wrapper-${id}`).remove();
    }
}
