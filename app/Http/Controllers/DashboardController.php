<?php
namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class DashboardController extends Controller
{
    public function index1()
    {
        if (!auth()->user()->role === 'peserta') {
            return redirect("dashboard-peserta");
        }

        return view("dashboard/pages/index1");
    }
    public function pengajuan(){
        $datas = new Pengajuan;
        return view("dashboard/pages/pengajuan", compact('datas'));
    }

    
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'surat' => 'nullable|mimes:pdf|max:5120',
        ]);
        // Handle file uploads
        $fotoPath = $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : null;
        $suratPath = $request->file('surat') ? $request->file('surat')->store('surats', 'public') : null;
        
        $pengajuan = new Pengajuan;
        $pengajuan->nama = $request->nama;
        $pengajuan->jurusan = $request->jurusan;
        $pengajuan->alamat = $request->alamat;
        $pengajuan->asal_sekolah = $request->asal_sekolah;
        $pengajuan->nim = $request->nim;
        $pengajuan->tgl_awal = $request->tgl_awal;
        $pengajuan->tgl_akhir = $request->tgl_akhir;
        $pengajuan->email = $request->email;
        $pengajuan->no_hp = $request->no_hp;
        $pengajuan->surat = $suratPath;
        $pengajuan->foto = $fotoPath;
        $pengajuan->save();
      
        return redirect('status-pengajuan')->with('success', 'Pengajuan Berhasil Tersimpan');;
    }
    
    public function statusPengajuan() {
        $datas = Pengajuan::where('id', auth()->user()->id)->get();
        return view("dashboard.pages.status", compact('datas'));
    }
     public function index(){
        return view("admin.layouts.main");
     }
     public function dashboard(){
        return view("admin.pages.dashboard");
     }

     public function dataPeserta(){
        $datas = Pengajuan::paginate(10); // Menampilkan 10 data per halaman
        return view("admin.pages.peserta.index", compact('datas'));
     }

     public function statusPeserta($id){
        $pengajuan = Pengajuan::where('id', $id)->first();
        return view("admin.pages.peserta.status", compact('pengajuan'));
     }

    public function konfirmasiPeserta(Request $request, $id){
        $request->validate([
            'status' => 'required|string|in:diterima,ditolak,active'
       ]);
    
        $id = $request->id;
        $status = $request->status;
        // Periksa jika status tidak diisi, setel ke "menunggu"
        if (empty($status)) {
            $status = 'belum diisi';
        }

        $dataBaru = [
            "status" =>  $status
        ];
        $konfirmasi = Pengajuan::where("id", $id)->update($dataBaru);

        return redirect('dashboard-data-peserta')->with('success', 'Status Berhasil Tersimpan');;
    }
    public function show($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->first();
        return view('admin.pages.peserta.show', compact('pengajuan'));
    }
   
    public function hapusPeserta($id)
    {
        $datas = Pengajuan::findOrFail($id);
        $datas->delete();
        return redirect('dashboard-data-peserta')->with(['success' => 'Berhasil hapus']);
    }

    public function bantuan(){
        return view('dashboard.bantuan');
    }

    public function profile(){
        $user = Pengajuan:: all();
        return view('admin.pages.peserta.profile', compact('user'));
    }

    public function showProfile()
    {
        $user = User::findOrFail(Auth::id());
        return view('admin.pages.peserta.profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        //validate 
        request()->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email, ' . $id . ',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Tolong periksa passwordnya lagi')])
                    ->withInput();
            }
        }
        if (request()->hasFile('foto')) {
            //kodingan dibawah ini untuk pengecekan apakah foto sudah ada atau belum
            if ($user->foto && file_exists(storage_path('app/public/fotos/' . $user->foto))) {
                Storage::delete('public/fotos' . $user->foto);
            }
            //proses requst foto setelah dicek
            $file = $request->file('foto');
            $fileName = 'foto-' . uniqid() . $file->getClientOriginalName();
            //pengecekan ekstension, dia sebagai .png .jpg. jpeg dan seterusnya 
            // $fileName = '.'. $file->getClientOriginalExtension();
            //dimasukan ke file storagenya 
            $request->foto->move(storage_path('app/public/fotos/'), $fileName);
            //request menggunakan eloquent
            $user->foto = $fileName;
        }
        $user->role = $request->role ?? 'peserta';
        $user->save();
        return back()->with('success', 'Profile Terupdate');
    }
}