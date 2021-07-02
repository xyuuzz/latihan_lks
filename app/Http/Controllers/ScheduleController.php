<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Studio;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Jadwal Tayang Film";
        $list_jadwal = Schedule::latest()->paginate(2);
        return view("Schedules.index", compact("title", "list_jadwal"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Buat Jadwal Penayangan";
        $desc = "Isi form dibawah untuk membuat jadwal penanyangan film";
        $url = route("schedule.store");
        $action = "Tambah";
        $list_film = Movie::all();
        $list_studio = Studio::all();
        return view("Schedules.create", compact("title", "desc", "list_film", "url", "list_studio", "action"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        // menggunakan konsep destructuring array
        [$movie, $start, $end] = $this->kelola_waktu($request);

        // push to database
        $movie->schedule()->create([
            "slug" => \Str::slug($movie->name) . uniqid(),
            "studio_id" => $request->studio,
            "start" => $start,
            "end" => $end
        ]);

        session()->flash("success", "Berhasil menambahkan satu jadwal penanyangan film!");
        return redirect()->route("schedule.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $title = "Sunting Jadwal Penayangan";
        $desc = "Sunting jadwal penanyangan dengan mengubah form dibawah";
        $url = route("schedule.update", ["schedule" => $schedule->slug, "page" => request("page")]);
        $action = "Edit";
        $list_film = Movie::all();
        $list_studio = Studio::all();
        return view("Schedules.create", compact("title", "desc", "list_film", "url", "list_studio", "schedule", "action"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Schedule $schedule, $page)
    {
        // menggunakan konsep destructuring array
        [$movie, $start, $end] = $this->kelola_waktu($request);

        // push to database
        $schedule->update([
            "slug" => \Str::slug($movie->name) . uniqid(),
            "movie_id" => $request->movie,
            "studio_id" => $request->studio,
            "start" => $start,
            "end" => $end
        ]);

        session()->flash("success", "Berhasil mensunting jadwal penanyangan film {$movie->name}");
        return redirect()->route("schedule.index", ["page" => $page]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, $page)
    {
        $schedule->delete();

        // hitung semua jadwal dan bagi dengan page, bulatkan ke atas, jika hasilnya == page, maka page tidak berubah, namun jika hasilnya tidak sama dengan page, maka page - 1
        $page = ceil(count(Schedule::all()) / $page) == $page ? $page : $page - 1;

        session()->flash("success", "Berhasil menghapus data penanyangan film!");
        // page === 0 maka menyatakan bahwa schedule tidak ada/habis
        if($page > 0)
        {
            return redirect()->route("schedule.index", ["page" => $page]);
        }
        else
        {
            return redirect()->route("schedule.index");
        }
    }

    protected function kelola_waktu($request)
    {
        $pecahan_time = explode(":", $request->start_time); # pecah start time, ini berupa pukul
        $movie = Movie::find($request->movie); # cari movie sesuai dengan yang dipilih admin

        // tentukan durasi per jam, jika lebih dari 60 menit, maka bagi dengan 60, jika tidak maka 0
        $hour = $movie->duration >= 60 ? floor($movie->duration / 60) : 0;
        // tentukan durasi per menit, yaitu durasi modulus 60;
        $minute = $movie->duration % 60 ;
        // tentukan waktu selesainya film, yaitu pecahan_time index 0 (menunjukan jam) ditambah dengan hour, dan pecahan_time index 1 ditambah dengan minute, sambungkan dengan tanda : , agar menunjukan pukul
        $ending_time = $pecahan_time[0] + $hour . ":" . $pecahan_time[1] + $minute;


        // explode ending_time yang sudah dikalkulasikan di atas, jika index 1(minute) value nya lebih dari 60
        if(explode(":", $ending_time)[1] >= 60)
        {
            // ganti ed time dengan, mengkalkulasikan hour + 1(dari sisa minute), dan minute dikurangi 60
            $ending_time = ($pecahan_time[0] + $hour) + 1 . ":" . ($pecahan_time[1] + $minute) - 60;
        }

        // jika len dari ending time kurang dari sama dengan 4 / tidak berformat : 09:00 dan el index ke 0 tidak bernilai 0
        if(strlen($ending_time) <= 4  && $ending_time[0] != 0)
        {
            $ending_time = "0" . $ending_time;
        }

        // jika len dari ending time kurang dari 5
        if(strlen($ending_time) < 5)
        {

            // tambahkan ending time dengan angka 0 dibelakangnya
            $ending_time = $ending_time . "0" ;
        }

        // jika ending time nya lebih dari pukul 24.00 / tengah malam,
        if($ending_time > "24:00:00")
        {
            // tambahkan 1 hari pada ending tanggal nya
            $ending_date = date("Y-m-d",strtotime("+1 days", strtotime($request->start_date)));

            /*
                * pukul : 24:00
                ? 2 => index 0, 4 => index 1, 0 => 3, 0 => 4
            */
            // tambahkan ending time index 0 dan ke 1 (2 + 4 , dll), lalu ubah menjadi integer dan kurangi dengan 24, gabungkan dengan tanda : dan tambahkan dibelakang ending time dengan index ke 3 dan ke 4(:00 , dll)
            $ending_time = "0" .  intval($ending_time[0] . $ending_time[1]) - 24 . ":" . $ending_time[3] . $ending_time[4];
        }


        // tanggal mulai/start : yaitu start_date digabung dengan start_time yang ditambahkan :00 dibelakangnya, sambungkan start_date dan start_time dengan spasi
        $start = $request->start_date . " " . ($request->start_time . ":00");
        // tanggal berakhir/ending : yaitu ending_date jika ada, jika tidak maka formatnya seperti diatas namun start_time diganti dengan ending_time
        $end = isset($ending_date) ? $ending_date . " " . ($ending_time. ":00") : $request->start_date . " " . ($ending_time . ":00");

        return [$movie, $start, $end];
    }
}
