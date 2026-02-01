@extends('base.guest')
@section('title', 'Document Request Checker - Registrar Office (QSU)')
@section(section: 'head')
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
@section('form')
    <div class="col-md-12 d-md-block">
        <div class="animated fadeInDown">
            <form class="m-t" role="form" action="{{ route('checker') }}" method="GET">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="search-container">
                                <input type="text" class="form-control search-input border-secondary text-dark" autocomplete="off"
                                    name="student_id" placeholder="Search by student id number... E.g. 19-11270" required>
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <section class="col-sm-12 faq-section animated fadeIn" loading="lazy">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            What are the requeirements for Transcript of Records?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <p>
                                Clearance, F-137/OTR (from previous school).
                            </p>
                        </div>
                    </div>
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            Is this a question?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <p>
                                Yes?
                            </p>
                        </div>
                    </div>
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            A question that will be answered by clicking this?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <p>
                                Okay.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script defer>
        const faqItems = document.querySelectorAll(".faq-item");

        faqItems.forEach(item => {
            const btn = item.querySelector(".faq-question");

            btn.addEventListener("click", () => {
                faqItems.forEach(i => {
                    if (i !== item) {
                        i.classList.remove("active");
                        i.querySelector(".icon").textContent = "+";
                    }
                });
                item.classList.toggle("active");
                const icon = item.querySelector(".icon");
                icon.textContent = item.classList.contains("active") ? "-" : "+";
            });
        });
    </script>

@endsection
