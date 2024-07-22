@extends('dashboard/main')

@section("content")
<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-md-8">
			<form role="form">
                <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nama Lengkap</label> 
                    <div class="col-8">
                      <input id="text" name="text" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text1" class="col-4 col-form-label">Universitas / Sekolah</label> 
                    <div class="col-8">
                      <input id="text1" name="text1" placeholder="e.g. Universitas Dumai" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text2" class="col-4 col-form-label">Nim</label> 
                    <div class="col-8">
                      <input id="text2" name="text2" placeholder="e.g. 1234567" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text3" class="col-4 col-form-label">Jurusan / Fakultas</label> 
                    <div class="col-8">
                      <input id="text3" name="text3" placeholder="e.g. Teknik Informatika" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text4" class="col-4 col-form-label">Semester / Kelas</label> 
                    <div class="col-8">
                      <input id="text4" name="text4" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text5" class="col-4 col-form-label">Mulai Periode</label> 
                    <div class="col-8">
                      <input id="text5" name="text5" type="date" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text6" class="col-4 col-form-label">Selesai Periode</label> 
                    <div class="col-8">
                      <input id="text6" name="text6" type="date" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text6" class="col-4 col-form-label">Alamat</label> 
                    <div class="col-8">
                      <input id="text6" name="text7" type="text" class="form-control">
                    </div>
                  </div>
			
			</form>
		</div>
		<div class="col-md-4">
			<form role="form">
					<label for="exampleInputFile">
						File input
					</label>
					<input type="file" class="form-control-file" id="exampleInputFile" />
					<p class="help-block">
						Example block-level help text here.
					</p>
				
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <dl>
                                <dt>
                                    Info!
                                </dt>
                                <p>
                                Sebelum mengupload surat pengantar,harap untuk diperiksa kembali agar mengurangi kesalahan    
                                </p>                                
                            </dl>
                        </div>
                    </div>
                </div>				
            </div>
				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>
		</div>
	</div>
</div>
@endsection