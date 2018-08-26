<?php

namespace App\Http\Controllers\Painel;

use App\Criteria\Report\ReportCriteria;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Comission;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Khill\Lavacharts\Lavacharts;

class ChartsController extends Controller
{
    public function getClients()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Número de Clientes');

        $data = $this->getClientsChartData(new Client());

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        Lava::LineChart('clients', $dataChart, [

            'legend' => [
                'position' => 'none'
            ]
        ]);
    }

    public function getSales()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Valor de Vendas');

        $data = $this->getSalesChartData(new Sale(), 'value');

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        Lava::LineChart('sales', $dataChart, [
            'legend' => [
                'position' => 'none'
            ]
        ]);
    }

    public function getComissions()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Valor de Vendas');

        $data = $this->getComissionsChartData(new Comission(), 'value');

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        Lava::LineChart('comissions', $dataChart, [
            'legend' => [
                'position' => 'none'
            ]
        ]);
    }

    public function getRefunds()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Valor de Vendas');

        $data = $this->getRefundsChartData(new Sale(), 'refundValue');

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        Lava::LineChart('refunds', $dataChart, [

            'legend' => [
                'position' => 'none'
            ]
        ]);
    }

    public function getComissionRefunds()
    {
        $dataChart = Lava::DataTable();

        $dataChart->addStringColumn('Mes/Ano')
                ->addNumberColumn('Valor de Vendas');

        $data = $this->getComissionRefundsChartData(new Comission(), 'value');

        foreach ($data as $item) {
            $date = str_pad($item['m'], 2, 0, STR_PAD_LEFT).'/'.$item['y'];
            $total = $item['total'];

            $dataChart->addRow([$date, $total]);
        }

        Lava::LineChart('comissionRefunds', $dataChart, [

            'legend' => [
                'position' => 'none'
            ]
        ]);
    }

    private function getClientsChartData($model)
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

    private function getSalesChartData($model, $column)
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
                        DB::raw("sum(".$column.") as total")
                    ]);
    }

    private function getComissionsChartData($model, $column)
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
                        DB::raw("sum(".$column.") as total")
                    ]);
    }

    private function getRefundsChartData($model, $column)
    {
        $beginDate = Carbon::now()/*->subMonths(5)*/->startOfMonth();
        $endDate = Carbon::now()->addMonths(12)->endOfMonth();

        return $model
                    ->groupBy(DB::raw("YEAR(deadline)"))
                    ->groupBy(DB::raw("MONTH(deadline)"))
                    ->where('deadline', 'between', DB::raw("'".$beginDate."' and '".$endDate."'"))
                    ->orderBy('y')
                    ->orderBy('m')
                    ->get([
                        DB::raw("MONTH(deadline) as m"), 
                        DB::raw("YEAR(deadline) as y"), 
                        DB::raw("sum(".$column.") as total")
                    ]);
    }

    private function getComissionRefundsChartData($model, $column)
    {
        $beginDate = Carbon::now()/*->subMonths(5)*/->startOfMonth();
        $endDate = Carbon::now()->addMonths(12)->endOfMonth();

        return $model
                    ->groupBy(DB::raw("YEAR(deadline)"))
                    ->groupBy(DB::raw("MONTH(deadline)"))
                    ->where('deadline', 'between', DB::raw("'".$beginDate."' and '".$endDate."'"))
                    ->orderBy('y')
                    ->orderBy('m')
                    ->get([
                        DB::raw("MONTH(deadline) as m"), 
                        DB::raw("YEAR(deadline) as y"), 
                        DB::raw("sum(".$column.") as total")
                    ]);
    }
}
