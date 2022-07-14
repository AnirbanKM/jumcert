<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- owl carousel JS -->
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('frontend/js/app.js') }}"></script>

<!-- Slim Nav Script -->
<script src="{{ asset('frontend/js/jquery.slimNav_sk78.min.js') }}"></script>


<!-- Mobile Nav Script -->
<script>
    // $(document).ready(function() {
    //     $('#navigation nav').slimNav_sk78();
    //     $('#nav-icon0').click(function() {
    //         $(this).toggleClass('open');
    //     });
    // });
</script>

<script>
    $(document).ready(function() {
        //accordian
        let question = document.querySelectorAll(".help-section1 .right-help-section1 .question");

        question.forEach(question => {
            question.addEventListener("click", event => {
                const active = document.querySelector(".question.active");
                if (active && active !== question) {
                    active.classList.toggle("active");
                    active.nextElementSibling.style.maxHeight = 0;
                }
                question.classList.toggle("active");
                const answer = question.nextElementSibling;
                if (question.classList.contains("active")) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                } else {
                    answer.style.maxHeight = 0;
                }
            })
        })

        // **** Get user profile image ****
        function usercheck() {

            var profileImg = $('#profileImg');
            var miniProfileImg = $('#miniProfileImg');

            $.ajax({
                url: '{{ route('get_user_info') }}',
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    if (resp != "" && resp.status == 200) {
                        if (resp.image === 'public/defaultImage/user.png') {
                            var img = resp.image;
                            var setImg = img.replace('public', 'storage', resp.image);

                            var baseURL = '{{ route('home') }}';
                            var src = baseURL + '/' + setImg;

                            $("#profileImg").attr("src", src);
                            $("#miniProfileImg").attr("src", src);
                        } else {
                            $("#profileImg").attr("src", resp.image);
                            $("#miniProfileImg").attr("src", resp.image);
                        }
                    } else {
                        // Condtion will add later
                        console.log(resp);
                    }
                }
            })
        }

        // **** Count total no of visitor on a particular stream or in our site ****
        function stream_record_create() {
            $.ajax({
                url: '{{ route('stream_record_create') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    event_id: 1
                },
                success: function(resp) {
                    console.log(resp);
                }
            })
        }

        $('body').on('click', '.close', function(event) {
            $('.modal').removeClass('fade').css('display', 'none');
        });

        @auth
        usercheck();
        stream_record_create();
    @endauth
    });

    $('#regBtn').click(function() {
        $('#smallModal2').show().css('display', 'block').addClass('show');
    });
</script>
