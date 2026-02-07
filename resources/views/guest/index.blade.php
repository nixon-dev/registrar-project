@extends('base.guest')
@section('title', 'Document Request Checker - Registrar Office (QSU)')
@section('form')
    <div class="col-md-12 d-md-block">
        <div class="animated fadeInDown">

            <form action="{{ route('checker') }}" method="GET">
                <div class="input-group search-box">
                    <input type="text" class="form-control" name="student_id"
                        placeholder="Search by student id number... E.g. 19-123456" pattern="^[0-9]{2}-[0-9]{4,6}$" required>

                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div>

            <section class="col-sm-12 faq-section animated fadeIn" loading="lazy">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            What are the requirements for Transcript of Records?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <span>For Fresh Graduates</span>
                            <ul>
                                <li>Clearance</li>
                                <li>Form 137(if you are from Senior High School or Highschool)</li>
                                <li>OTR (if you came from another college/university)</li>
                            </ul>
                            <span>For Transfeering Out</span>
                            <ul>
                                <li>Partial Clearance</li>
                                <li>Form 137(if you are from Senior High School)</li>
                                <li>OTR (if you came from another college/university)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            How long does processing usually takes?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <ul>
                                <li> Transcript of Records takes 5-15 working days.
                                </li>
                                <li>Reconstitued Diploma takes 15-30 working days.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            What should I do if my request is not showing?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <ul>
                                <li>Double-check your Student ID and make sure the format is correct (example: 19-1234).
                                </li>
                                <li>If your request was submitted recently, it may still be in the queue and will appear
                                    once it has been processed by the Registrar Staff.</li>
                                <li>If it still does not appear after 24–48 hours, please contact the Registrar Office for
                                    assistance.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item dark-skin-2">
                        <button class="faq-question text-white">
                            Can I request documents online using this system?<span class="icon">+</span>
                        </button>
                        <div class="faq-answer dark-skin-2">
                            <p>
                                No. This system is only for tracking the status of your document request.
                                Students must personally submit the required documents (such as clearance) and payment at
                                the Cashier.
                            </p>
                            <p>
                                If you cannot attend personally, you may authorize someone to submit your requirements on
                                your behalf
                                through an Authorization Letter, along with a photocopy of your ID (any valid ID) and the
                                valid ID of your authorized representative.
                            </p>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>



@endsection
