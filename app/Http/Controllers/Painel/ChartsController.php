<?php

namespace App\Http\Controllers\Painel;

use App\Criteria\Report\ReportCriteria;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Khill\Lavacharts\Lavacharts;

class ChartsController extends Controller
{
    private $lavaChart;

    public function __construct(Lavacharts $lavaChart)
    {
        $this->lavaChart = $lavaChart;
    }

    public function show($title)
    {
        switch ($title) {
            case 'clients':
                $chart = $this->getClients();
                break;
            
            default:
                # code...
                break;
        }

        return view('painel.charts.chart', compact('chart'));
    }

    private function getClients()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Número de Clientes');

        $data = $this->getCreationChart(new Client());

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        $chart = Lava::LineChart('Chart', $dataChart, [
            'title' => 'Clientes',
            'titleTextStyle' => [
                'fontName' => 'Raleway',
                'fontSize' => 20
            ],
            'legend' => [
                'position' => 'top'
            ]
        ]);

        return $chart;
    }

    private function getCreationChart($model)
    {
        $beginDate = Carbon::now()->subYear()->startOfMonth();

        return $model
                    ->groupBy(DB::raw("YEAR(created_at)"))
                    ->groupBy(DB::raw("MONTH(created_at)"))
                    ->where('created_at', '>', "'".$beginDate."'")
                    ->orderBy('y')
                    ->orderBy('m')
                    ->get([
                        DB::raw("MONTH(created_at) as m"), 
                        DB::raw("YEAR(created_at) as y"), 
                        DB::raw("count(*) as total")
                    ]);
    }
}
