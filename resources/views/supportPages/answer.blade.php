@extends("layouts.main")

@section("title", "MNS Game | Поддержка")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    {{--    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.3/dist/flowbite.min.css" />--}}
@endsection

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="relative w-full px-6 py-6 bg-white ring-1  ring-gray-900/5 md:max-w-3xl md:mx-auto lg:max-w-4xl lg:pt-8 lg:pb-14 lg:!px-0 mb-5 rounded-2">
        <div class="mt-4 prose prose-slate mx-auto">
            <h1 class="text-left">
                <span class="text-2xl font-black leading-none text-gray-900">
                    <span class="">MNS Game Support</span><span class="text-indigo-600">.</span><br>{{$answer->title}}
                </span>
            </h1>
            <p class="p-1 text-sm">{{$answer->answer}}</p>
        </div>
        <div class="relative flex py-3 items-center mt-5 mb-5">
            <div class="flex-grow border-t border-gray-400"></div>
        </div>
        <div class="prose prose-slate mx-auto text-center lg:!text-left">
            <span class="lg:inline font-medium mr-4 font-[500]" id="feedback-text">
                    Эта информация оказалась полезной?
            </span>
            <div class="lg:inline mt-2 mb-6 lg:!mt-0 lg:!mb-0" id="feedback-buttons">
                <button class="border-2 h-10 w-20 align-middle px-3 rounded-3 mx-1 hover:!ring-1 hover:shadow-lg focus:!shadow-none" onclick="rateAnswer(1)">Да</button>
                <button class="border-2 h-10 w-20 align-middle px-3 rounded-3 mx-1 hover:!ring-1 hover:shadow-lg focus:!shadow-none" onclick="rateAnswer(2)">Нет</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script>
        function rateAnswer(type) {
            let answer_id = {{ $answer->id }};

            const request = new XMLHttpRequest();

            const url = "{{ url("/support/faq/answer/helpful") }}";

            const params = "&answer_id=" + answer_id + "&type=" + type;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {

                if(request.readyState === 4 && request.status === 200) {
                    let feedback_buttons = document.getElementById("feedback-buttons");
                    feedback_buttons.hidden = true;

                    let feedback_text = document.getElementById("feedback-text");
                    feedback_text.classList.add("!font-black");
                    feedback_text.parentElement.classList.add("mb-6");
                    feedback_text.parentElement.classList.add("lg:mb-0");
                    feedback_text.innerHTML = "Спасибо за ваш отзыв!";
                }
            });

            request.send(params);
        }
    </script>
@endsection
