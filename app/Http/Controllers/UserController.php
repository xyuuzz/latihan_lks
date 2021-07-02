<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Studio;
use App\Models\Schedule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $title = "Home";
        $rec_film = Schedule::where("start", ">=", date("Y-m-d H:i:s", strtotime("next month")))
                            ->limit(2)
                            ->get();
        $list_jadwal = Schedule::where("end", "<=", date("Y-m-d H:i:s", strtotime("next week")))->get();
        return view("index", compact("title", "list_jadwal", "rec_film"));
    }

    public function search_branch()
    {
        $result = "";
        $query = request("query");

        if (strlen($query))
        {
            $cabang = Branch::where("name", "like", "%$query%")->get("id")->toArray();
            $studio = Studio::whereIn("branch_id", [...$cabang])->get("id")->toArray();
            $list_jadwal = Schedule::where("end", "<=", date("Y-m-d H:i:s", strtotime("next week")))
                                ->whereIn("studio_id", [...$studio])->get();
            if (count($list_jadwal))
            {
                $result .= $this->search($list_jadwal);
            }
            else
            {
                $result .= '
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="text-center">Tidak ada jadwal film yang ada di kota ' . $query . ' minggu ini</h5>
                    </div>
                </div>';
            }
        }
        else
        {
            $result .= $this->search(Schedule::
            where("end", "<=", date("Y-m-d H:i:s", strtotime("next week")))
            ->get());
        }

        echo $result;
    }

    public function search_date()
    {
        $result = "";
        $query = request("query");


        if(strlen($query))
        {
            $list_jadwal = Schedule::where("start", "like", "%$query%")->get();

            if(count($list_jadwal))
            {
                $result .= $this->search($list_jadwal);
            }
            else
            {
                $result .= '
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="text-center">Tidak ada penayangan film pada tanggal tersebut</h5>
                    </div>
                </div>';
            }
        }
        else
        {
            $result .= $this->search(Schedule::
            where("end", "<=", date("Y-m-d H:i:s", strtotime("next week")))
            ->get());
        }

        echo $result;
    }

    protected function search($data)
    {
        $result = "";
        foreach ($data as $jadwal)
        {
            $result .= '
            <div class="card mt-4">
                <div class="card-body">
                    <h4>Tanggal penayangan : <b>' . strftime("%A, %d %B %Y", strtotime($jadwal->start)) . ' <b></h4>
                    <p>Tersedia di bioskop : <b>' . $jadwal->studio->name . '<b></p>
                    <p>Kota : ' . $jadwal->studio->branch->name . '</p>
                    <p>Judul film : <b>' . $jadwal->movie->name . '</b></p>
                    <p>Durasi : ' . $jadwal->movie->duration . ' Menit </p>
                    <p>Tanggal penayangan : ' . date("d-m-Y", strtotime($jadwal->start)) . '</p>
                    <p>Jam tayang : ' . date("H:i", strtotime($jadwal->start)) . ' - ' . date("H:i", strtotime($jadwal->end)) . '</p>
                    <button type="button" class="btn btn-outline-primary d-block mb-3" data-toggle="modal" data-target="#exampleModal">
                        Pesan Sekarang
                    </button>
                    <img class="rounded shadow w-img img-fluid" src="' . asset("storage/images/{$jadwal->movie->image}") . '" alt="">
                </div>
            </div>';
        }

        return $result;
    }
}
