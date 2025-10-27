@extends('base.guest')
@section('title', 'Document Request Checker - Registrar Office (QSU)')
@section(section: 'head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .search-container {
            position: relative;
        }

        .search-input {
            height: 50px;
            border-radius: 30px;
            padding-left: 35px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }

        .faq-section {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            font-family: "Segoe UI", sans-serif;
        }

        .faq-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .faq-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            outline: none;
            text-align: left;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .faq-question .icon {
            transition: transform 0.3s ease;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            border: none;
            transition: max-height 0.4s ease, padding 0.3s ease;
            padding: 0 0;
        }

        .faq-answer p {
            margin: 10px 0;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
            padding: 10px 0;
        }

        .faq-item.active .faq-question .icon {
            transform: rotate(180deg);
            content: "–";
        }
    </style>
@endsection
@section('form')
    <div class="col-md-12 d-md-block">
        <div class="">
            <form class="m-t" role="form" action="{{ route('checker') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="search-container">
                                <input type="text" class="form-control search-input  border-secondary" name="student_id"
                                    placeholder="Search by student id number... E.g. 19-11270" required>
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary full-width m-b d-none">Check</button>
            </form>
        </div>
        <div>
            <section class="col-sm-12 faq-section">
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
                    </div><div class="faq-item dark-skin-2">
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

    <script>
        const faqItems = document.querySelectorAll(".faq-item");

        faqItems.forEach(item => {
            const btn = item.querySelector(".faq-question");

            btn.addEventListener("click", () => {
                // close other items
                faqItems.forEach(i => {
                    if (i !== item) {
                        i.classList.remove("active");
                        i.querySelector(".icon").textContent = "+";
                    }
                });

                // toggle current item
                item.classList.toggle("active");

                const icon = item.querySelector(".icon");
                icon.textContent = item.classList.contains("active") ? "-" : "+";
            });
        });
    </script>

@endsection
