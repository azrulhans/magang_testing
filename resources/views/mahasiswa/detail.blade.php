
<table class="table">
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>Nama Lengkap</td>
            <td width="75%">:{{$d-> nama}} </td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td width="75%">:{{$d-> jurusan}} </td>
        </tr>
        <tr>
            <td>Nim</td>
            <td width="75%">: {{$d-> nim}} </td>
        </tr>
        <tr>
            <td>Asal Sekolah/Kampus</td>
            <td width="75%">:{{$d-> asal_sekolah}} </td>
        </tr>
        <tr>
            <td>Email</td>
            <td width="75%">:{{$d-> email}} </td>
        </tr>
        <tr>
            <td>Alamat/td>
            <td width="75%">:{{$d-> alamat}} </td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td width="75%">:{{$d-> no_hp}} </td>
        </tr>
        <tr>
            <td>Mulai Magang</td>
            <td width="75%">:{{$d-> tgl_awal}} </td>
        </tr>
        <tr>
            <td>Akhir Magang</td>
            <td width="75%">:{{$d-> tgl_akhir}} </td>
        </tr>
        <tr>
            <td>Foto</td>
            <td width="75%">: 
                @if($d->foto)
                <img src="{{ asset('storage/' . $d->foto) }}" alt="Foto {{ $d->nama }}" width="80" height="80">
            @else
                Tidak ada foto
            @endif    
            </td>
        </tr>
        <tr>
            <td>Surat</td>
            <td width="75%">: 
                @if($d->surat)
                <a href="{{ asset('storage/' . $d->surat) }}" target="_blank">Lihat Surat</a>
            @else
                Tidak ada surat
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>