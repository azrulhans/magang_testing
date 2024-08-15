@extends("dashboard.main")
@section('content')
<div class="d-flex justify-content-center">
    <div class="card" style="width: 60%; align: center;">
        <div class="card-header">
            <h4>Form Bantuan</h4>
        </div>
        <div class="card-body" style="width: 100%">
            <form>
                <div class="row-12 g-3 ">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                            <label for="name">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                            <label for="subject">Tentang</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                            <label for="message">Pesan</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3 d-flex large justify-content-center">
                        <button class="btn btn-primary btn-lg">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
