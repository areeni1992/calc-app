<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <div class="content-wrapper">
        <section class="form-section">
            <header class="form-header">
                <article class="form-header_content">
                    <span class="form-title">Average Calculator</span>
                    <p class="form-info">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eum
                        consectetur explicabo, molestias, hic aut perferendis, deleniti
                        dolores repellendus natus numquam. Qui laborum alias eligendi, ab
                        voluptas itaque? Exercitationem, minima? Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Suscipit veniam sit quisquam
                        vero quod. Eum velit excepturi id ratione, facere aut sequi
                        architecto tempora a numquam odit quidem totam exercitationem.
                    </p>
                </article>
                <figure class="form-header_img">
                    <img src="https://img.freepik.com/free-vector/calculator-concept-illustration_114360-2686.jpg?w=2000"
                        alt="" />
                </figure>
            </header>

            @if (Session::has('status') == 'success' || Session::has('status') == 'error' || $errors->any())
                <div
                    class="alert alert-{{ session()->has('status') == 'success' ? 'success' : 'danger' }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-{{ session()->has('status') == 'success' ? 'check' : 'ban' }}"></i>
                        {{ Session::get('status') == 'success' ? Session::get('message') : 'Error' }}!
                    </h5>
                </div>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif


            <form class="marks-form" id="marks-form">
                @csrf
                <div class="form-group">
                    <label for="student_name" class="form-label">Student Name</label>
                    <input type="text" id="student_name" name="student_name" class="form-input"
                        placeholder="Enter Student Name" />
                </div>
                <div class="form-group">
                    <label for="mid_mark" class="form-label">Mid Term</label>
                    <input type="number" id="mid_mark" name="mid_mark" class="form-input" placeholder="Enter Mark" />
                </div>
                <div class="form-group">
                    <label for="final_mark" class="form-label">Final</label>
                    <input type="number" id="final_mark" name="final_mark" class="form-input"
                        placeholder="Enter Mark" />
                </div>
                <div class="form-group">
                    <label for="activity_marks" class="form-label">Activities</label>
                    <input type="number" id="activity_marks" name="activity_marks" class="form-input"
                        placeholder="Enter Mark" />
                </div>
                <button type="button" class="form-btn" onclick="addStudentMark();">SAVE</button>
            </form>
        </section>
        <section>
            @foreach ($data as $item)
                <section class="card">
                    <article class="card-top-content">
                        <div class="card-top-content-leading">
                            <span class="name-first-char">S</span>
                            <div class="student-info">
                                <span>{{ $item->student_name }}</span>
                                <span>{{ $item->id }}</span>
                            </div>
                        </div>
                        <a href="#">
                            <i class="fa-solid fa-xmark delete-row"></i>
                        </a>
                    </article>
                    <article class="card-marks">
                        <section class="mark-info">
                            <span>Mid-Term</span>
                            <span>{{ $item->mid_mark }}</span>
                        </section>
                        <section class="mark-info">
                            <span>Final-Term</span>
                            <span>{{ $item->final_mark }}</span>
                        </section>
                        <section class="mark-info">
                            <span>Activities</span>
                            <span>{{ $item->activity_marks }}</span>
                        </section>
                    </article>
                </section>
            @endforeach
        </section>

    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function addStudentMark() {
            axios.post('{{ route('students.store') }}', {
                student_name: document.getElementById('student_name').value,
                mid_mark: document.getElementById('mid_mark').value,
                final_mark: document.getElementById('final_mark').value,
                activity_marks: document.getElementById('activity_marks').value
            }).then(function(response) {
                toastr.success(response.data.message);
                document.getElementById('marks-form').reset();
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
</body>

</html>
