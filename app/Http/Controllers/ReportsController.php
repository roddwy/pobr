<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\State;
use App\Property;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;
use PHPExcel_Worksheet_Drawing;
use PDF;
use Khill\Lavacharts\Lavacharts;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGraphGeneral()
    {
        /*PRIMER GRAFICO*/
        $lava = new Lavacharts;
        $graphic = $lava->DataTable();
        $graphic->addDateColumn('Month');
        $graphic->addNumberColumn('Propiedades');
        $properties = Property::select(DB::raw('Month(admission_date) AS mes'),DB::raw('count(*) as total'))
                                        ->groupBy('mes')
                                        ->orderBy('mes', 'ASC')
                                        ->get();
         foreach ($properties as $key => $property) {
                  $graphic->addRow(['2017-'.$property->mes, $property->total]);    
         }        
        $lava->LineChart("Notasgrap", $graphic,['title'=> 'INMUEBLES REGISTRADOS POR CADA MES']);
        /*END PRIMER GRAFICO*/
        return $lava;
    }
    public function getGraphPie()
    {
        $users = User::all();
        $lava = new Lavacharts; // See note below for Laravel

        $reasons = $lava->DataTable();

        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percen');
        foreach ($users as $key => $user) {
            $properties = Property::where('user_id','=',$user->id)->get();
            $reasons->addRow([$user->first_name.' '.$user->last_name,count($properties)]);
        }
            // ->addRow(['Check Reviews', 15])
            // ->addRow(['Watch Trailers', 5])
            // ->addRow(['See Actors Other Work', 25])
            // ->addRow(['Settle Argument', 55]);

        $lava->PieChart('IMDB', $reasons, [
            'title' => 'REGISTRO DE INMUEBLES POR USUARIO',
            'is3D' => true
        ]);
        return $lava;
    }
    public function index()
    {  
        $graphGeneral = self::getGraphGeneral();
        $graphPie = self::getGraphPie();
        
        return view('admin.reports.index',compact('graphPie'));
    }

    public function reportegeneral(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
            Excel::create('OrionBienesRaices2', function($excel) use($properties,$datoexacto){
            $excel->setTitle('Reporte General de Inmuebles');

            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');

            $excel->setDescription('Total de inmuebles dentro la empresa');
            $excel->sheet('Propiedades en General', function($sheet) use($properties,$datoexacto){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10
                    )
                ));
                $sheet->mergeCells('B2:O2');
                $sheet->mergeCells('B3:O3');
                $sheet->mergeCells('B4:O4');
                $sheet->mergeCells('B5:O5');

                $date = Carbon::now();
                $fecha = $date->format('d-m-y');
                $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                $objDrawing->setCoordinates('C3');
                $objDrawing->setWorksheet($sheet);
                
                //$sheet->setBorder('A1:AN1', 'thin');
                $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','','',''));
                $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','','',''));
                $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','','',''));
                $sheet->row(5, array('','Usuario '.$usuario, '', '', '', '','','','','','','','','',''));
                $sheet->cells('B2:O2', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');                    
                    $cells->setFontSize(20);
                    //$cells->setSize(15);
                });
                $sheet->cells('B3:O3', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B4:O4', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B5:O5', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });  
                //$sheet->fromArray($properties);
                $sheet->setBorder('B7:O7', 'thin');
                $sheet->cells('B7:O7', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });
                $sheet->mergeCells('H7:I7');
                $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','ESTADO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                
                $sheet->fromModel($properties, null, 'B8', false, false);
                $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                ->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                    $total = 0;
                    $totalofertas = 0;
                    $totalcomisones = 0;
                    foreach ($preciosventas as $precio) {
                        $total = $total+$precio->sale_price;
                        $totalofertas = $totalofertas+$precio->offer_price;
                        $totalcomisones = $totalcomisones+$precio->comission;
                    }                
                
                    $total= number_format($total,2);
                    $totalofertas = number_format($totalofertas,2);
                    $totalcomisones = number_format($totalcomisones,2);
                $fintabla = count($properties)+8;
                $sheet->row($fintabla,array('','','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                $sheet->cells('B'.$fintabla.':O'.$fintabla, function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });

                $range = 'B8:O'.$fintabla;
                $sheet->cells($range, function($cells) {
                      $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->download('xlsx');

    }
    /*REPORTE GENRAL PDF*/
    public function reportegeneralpdf(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        $totales = $properties;
        $total = 0;
        $totalofertas = 0;
        $totalcomisones = 0;
        foreach ($totales as $precio) {
            $total = $total+$precio->sale_price;
            $totalofertas = $totalofertas+$precio->offer_price;
            $totalcomisones = $totalcomisones+$precio->comission;
        }
        $total= number_format($total,2);
        $totalofertas = number_format($totalofertas,2);
        $totalcomisones = number_format($totalcomisones,2);
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
            //dd($properties);
        $pdf = PDF::loadView('admin.pdf.pdftotal',['properties'=>$properties,'date'=>$datoexacto,'user'=>$usuario,'total'=>$total,'totalofertas'=>$totalofertas,'totalcomisones'=>$totalcomisones]);
        return $pdf->stream('Reporte Total.pdf');
    }
    /*END REPORTE GENERAL PDF*/
    public function reportevendidos(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
            Excel::create('OrionBienesRaices2', function($excel) use($properties,$datoexacto){
            $excel->setTitle('Reporte General de Inmuebles');

            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');

            $excel->setDescription('Total de inmuebles dentro la empresa');
            $excel->sheet('Propiedades en General', function($sheet) use($properties,$datoexacto){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10
                    )
                ));
                $sheet->mergeCells('B2:N2');
                $sheet->mergeCells('B3:N3');
                $sheet->mergeCells('B4:N4');
                $sheet->mergeCells('B5:N5');

                $date = Carbon::now();
                $fecha = $date->format('d-m-y');
                $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                $objDrawing->setCoordinates('C3');
                $objDrawing->setWorksheet($sheet);
                
                //$sheet->setBorder('A1:AN1', 'thin');
                $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','',''));
                $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES VENDIDOS DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','',''));
                $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','',''));
                $sheet->row(5, array('','Usuario '.$usuario, '', '', '', '','','','','','','','',''));
                $sheet->cells('B2:N2', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');                    
                    $cells->setFontSize(20);
                    //$cells->setSize(15);
                });
                $sheet->cells('B3:N3', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B4:N4', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B5:N5', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });  
                //$sheet->fromArray($properties);
                $sheet->setBorder('B7:N7', 'thin');
                $sheet->cells('B7:N7', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });
                $sheet->mergeCells('H7:I7');
                $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                
                $sheet->fromModel($properties, null, 'B8', false, false);
                $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                ->where('states.name','=','Vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                    $total = 0;
                    $totalofertas = 0;
                    $totalcomisones = 0;
                    foreach ($preciosventas as $precio) {
                        $total = $total+$precio->sale_price;
                        $totalofertas = $totalofertas+$precio->offer_price;
                        $totalcomisones = $totalcomisones+$precio->comission;
                    }                
                
                    $total= number_format($total,2);
                    $totalofertas = number_format($totalofertas,2);
                    $totalcomisones = number_format($totalcomisones,2);
                $fintabla = count($properties)+8;
                $sheet->row($fintabla,array('','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                $sheet->cells('B'.$fintabla.':N'.$fintabla, function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });

                $range = 'B8:N'.$fintabla;
                $sheet->cells($range, function($cells) {
                      $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->download('xlsx');

    }
    /*REPORTES VENDIDOS PDF*/
    public function reportevendidospdf(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        $totales = $properties;
        $total = 0;
        $totalofertas = 0;
        $totalcomisones = 0;
        foreach ($totales as $precio) {
            $total = $total+$precio->sale_price;
            $totalofertas = $totalofertas+$precio->offer_price;
            $totalcomisones = $totalcomisones+$precio->comission;
        }
        $total= number_format($total,2);
        $totalofertas = number_format($totalofertas,2);
        $totalcomisones = number_format($totalcomisones,2);
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
            //dd($properties);
        $pdf = PDF::loadView('admin.pdf.pdfvendidos',['properties'=>$properties,'date'=>$datoexacto,'user'=>$usuario,'total'=>$total,'totalofertas'=>$totalofertas,'totalcomisones'=>$totalcomisones]);
        return $pdf->stream('Reporte Vendidos.pdf');
    }
    /*END REPORTES VENDIDOS PDF*/
    public function reporteactivos(Request $request)
    {
       $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Activo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
            Excel::create('OrionBienesRaices2', function($excel) use($properties,$datoexacto){
            $excel->setTitle('Reporte General de Inmuebles');

            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');

            $excel->setDescription('Total de inmuebles dentro la empresa');
            $excel->sheet('Propiedades en General', function($sheet) use($properties,$datoexacto){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10
                    )
                ));
                $sheet->mergeCells('B2:N2');
                $sheet->mergeCells('B3:N3');
                $sheet->mergeCells('B4:N4');
                $sheet->mergeCells('B5:N5');

                $date = Carbon::now();
                $fecha = $date->format('d-m-y');
                $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                $objDrawing->setCoordinates('C3');
                $objDrawing->setWorksheet($sheet);
                
                //$sheet->setBorder('A1:AN1', 'thin');
                $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','',''));
                $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES ACTIVOS DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','',''));
                $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','',''));
                $sheet->row(5, array('','Usuario '.$usuario, '', '', '', '','','','','','','','',''));
                $sheet->cells('B2:N2', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');                    
                    $cells->setFontSize(20);
                    //$cells->setSize(15);
                });
                $sheet->cells('B3:N3', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B4:N4', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B5:N5', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });  
                //$sheet->fromArray($properties);
                $sheet->setBorder('B7:N7', 'thin');
                $sheet->cells('B7:N7', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });
                $sheet->mergeCells('H7:I7');
                $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                
                $sheet->fromModel($properties, null, 'B8', false, false);
                $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                ->where('states.name','=','Activo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                    $total = 0;
                    $totalofertas = 0;
                    $totalcomisones = 0;
                    foreach ($preciosventas as $precio) {
                        $total = $total+$precio->sale_price;
                        $totalofertas = $totalofertas+$precio->offer_price;
                        $totalcomisones = $totalcomisones+$precio->comission;
                    }                
                
                    $total= number_format($total,2);
                    $totalofertas = number_format($totalofertas,2);
                    $totalcomisones = number_format($totalcomisones,2);
                $fintabla = count($properties)+8;
                $sheet->row($fintabla,array('','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                $sheet->cells('B'.$fintabla.':N'.$fintabla, function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });

                $range = 'B8:N'.$fintabla;
                $sheet->cells($range, function($cells) {
                      $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->download('xlsx');
    }
    /*REPORTE ACTIVOS PDF*/
    public function reporteactivospdf(Request $request)
    {
       $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Activo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        $totales = $properties;
        $total = 0;
        $totalofertas = 0;
        $totalcomisones = 0;
        foreach ($totales as $precio) {
            $total = $total+$precio->sale_price;
            $totalofertas = $totalofertas+$precio->offer_price;
            $totalcomisones = $totalcomisones+$precio->comission;
        }
        $total= number_format($total,2);
        $totalofertas = number_format($totalofertas,2);
        $totalcomisones = number_format($totalcomisones,2);
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
            //dd($properties);
        $pdf = PDF::loadView('admin.pdf.pdfactivos',['properties'=>$properties,'date'=>$datoexacto,'user'=>$usuario,'total'=>$total,'totalofertas'=>$totalofertas,'totalcomisones'=>$totalcomisones]);
        return $pdf->stream('Reporte Vendidos.pdf');
    }
    /*END REPORTE ACTIVOS PDF*/
    public function reporteinactivos(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Inactivo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
            Excel::create('OrionBienesRaices2', function($excel) use($properties,$datoexacto){
            $excel->setTitle('Reporte General de Inmuebles');

            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');

            $excel->setDescription('Total de inmuebles dentro la empresa');
            $excel->sheet('Propiedades en General', function($sheet) use($properties,$datoexacto){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10
                    )
                ));
                $sheet->mergeCells('B2:N2');
                $sheet->mergeCells('B3:N3');
                $sheet->mergeCells('B4:N4');
                $sheet->mergeCells('B5:N5');

                $date = Carbon::now();
                $fecha = $date->format('d-m-y');
                $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                $objDrawing->setCoordinates('C3');
                $objDrawing->setWorksheet($sheet);
                
                //$sheet->setBorder('A1:AN1', 'thin');
                $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','',''));
                $sheet->row(3, array('','TOTAL DE INMUEBLES DADOS DE BAJA DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','',''));
                $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','',''));
                $sheet->row(5, array('','Usuario '.$usuario, '', '', '', '','','','','','','','',''));
                $sheet->cells('B2:N2', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');                    
                    $cells->setFontSize(20);
                    //$cells->setSize(15);
                });
                $sheet->cells('B3:N3', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B4:N4', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B5:N5', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });  
                //$sheet->fromArray($properties);
                $sheet->setBorder('B7:N7', 'thin');
                $sheet->cells('B7:N7', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });
                $sheet->mergeCells('H7:I7');
                $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                
                $sheet->fromModel($properties, null, 'B8', false, false);
                $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                ->where('states.name','=','Inactivo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                    $total = 0;
                    $totalofertas = 0;
                    $totalcomisones = 0;
                    foreach ($preciosventas as $precio) {
                        $total = $total+$precio->sale_price;
                        $totalofertas = $totalofertas+$precio->offer_price;
                        $totalcomisones = $totalcomisones+$precio->comission;
                    }                
                
                    $total= number_format($total,2);
                    $totalofertas = number_format($totalofertas,2);
                    $totalcomisones = number_format($totalcomisones,2);
                $fintabla = count($properties)+8;
                $sheet->row($fintabla,array('','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                $sheet->cells('B'.$fintabla.':N'.$fintabla, function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });

                $range = 'B8:N'.$fintabla;
                $sheet->cells($range, function($cells) {
                      $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->download('xlsx');
    }
    /*REPORTES INACTIVOS PDF*/
    public function reporteinactivospdf(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Inactivo')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        $totales = $properties;
        $total = 0;
        $totalofertas = 0;
        $totalcomisones = 0;
        foreach ($totales as $precio) {
            $total = $total+$precio->sale_price;
            $totalofertas = $totalofertas+$precio->offer_price;
            $totalcomisones = $totalcomisones+$precio->comission;
        }
        $total= number_format($total,2);
        $totalofertas = number_format($totalofertas,2);
        $totalcomisones = number_format($totalcomisones,2);
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
            //dd($properties);
        $pdf = PDF::loadView('admin.pdf.pdfinactivos',['properties'=>$properties,'date'=>$datoexacto,'user'=>$usuario,'total'=>$total,'totalofertas'=>$totalofertas,'totalcomisones'=>$totalcomisones]);
        return $pdf->stream('Reporte Inactivos.pdf');
    }
    /*END REPORTES INACTIVOS PDF*/
    public function reporteofertas(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Oferta')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
            Excel::create('OrionBienesRaices2', function($excel) use($properties,$datoexacto){
            $excel->setTitle('Reporte General de Inmuebles');

            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');

            $excel->setDescription('Total de inmuebles dentro la empresa');
            $excel->sheet('Propiedades en General', function($sheet) use($properties,$datoexacto){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10
                    )
                ));
                $sheet->mergeCells('B2:N2');
                $sheet->mergeCells('B3:N3');
                $sheet->mergeCells('B4:N4');
                $sheet->mergeCells('B5:N5');

                $date = Carbon::now();
                $fecha = $date->format('d-m-y');
                $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                $objDrawing->setCoordinates('C3');
                $objDrawing->setWorksheet($sheet);
                
                //$sheet->setBorder('A1:AN1', 'thin');
                $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','',''));
                $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES OFERTAS DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','',''));
                $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','',''));
                $sheet->row(5, array('','Usuario '.$usuario, '', '', '', '','','','','','','','',''));
                $sheet->cells('B2:N2', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');                    
                    $cells->setFontSize(20);
                    //$cells->setSize(15);
                });
                $sheet->cells('B3:N3', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B4:N4', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });
                $sheet->cells('B5:N5', function($cells){
                    
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Arial Black');
                    $cells->setFontSize(12);
                    //$cells->setSize(15);
                });  
                //$sheet->fromArray($properties);
                $sheet->setBorder('B7:N7', 'thin');
                $sheet->cells('B7:N7', function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });
                $sheet->mergeCells('H7:I7');
                $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                
                $sheet->fromModel($properties, null, 'B8', false, false);
                $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                ->where('states.name','=','Oferta')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                    $total = 0;
                    $totalofertas = 0;
                    $totalcomisones = 0;
                    foreach ($preciosventas as $precio) {
                        $total = $total+$precio->sale_price;
                        $totalofertas = $totalofertas+$precio->offer_price;
                        $totalcomisones = $totalcomisones+$precio->comission;
                    }                
                
                    $total= number_format($total,2);
                    $totalofertas = number_format($totalofertas,2);
                    $totalcomisones = number_format($totalcomisones,2);
                $fintabla = count($properties)+8;
                $sheet->row($fintabla,array('','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                $sheet->cells('B'.$fintabla.':N'.$fintabla, function($cells){
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(10);
                });

                $range = 'B8:N'.$fintabla;
                $sheet->cells($range, function($cells) {
                      $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->download('xlsx');
    }
    /*REPORTES OFERTAS PDF*/
    public function reporteofertaspdf(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); 

        $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
            ->join('categories', 'categories.id','=','properties.category_id')
            ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
            ->join('states','states.id','=','properties.state_id')
            ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                    'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                    'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
            ->where('states.name','=','Oferta')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
            //dd($properties);
        $totales = $properties;
        $total = 0;
        $totalofertas = 0;
        $totalcomisones = 0;
        foreach ($totales as $precio) {
            $total = $total+$precio->sale_price;
            $totalofertas = $totalofertas+$precio->offer_price;
            $totalcomisones = $totalcomisones+$precio->comission;
        }
        $total= number_format($total,2);
        $totalofertas = number_format($totalofertas,2);
        $totalcomisones = number_format($totalcomisones,2);
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
        $pdf = PDF::loadView('admin.pdf.pdfofertas',['properties'=>$properties,'date'=>$datoexacto,'user'=>$usuario,'total'=>$total,'totalofertas'=>$totalofertas,'totalcomisones'=>$totalcomisones]);
        return $pdf->stream('Reporte Ofertas.pdf');
    }
    /*END REPORTES OFERTAS PDF*/

    /*REPORTES POR CADA USUARIO DEL SISTEMA*/

    public function reporteusuariototal()
    {
        /*$date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m'); */

        $usuarios = User::select('users.id','users.first_name','users.last_name')->get();
           // dd($usuarios);

        Excel::create('Reporte Usuarios', function($excel) use($usuarios){
            $excel->setTitle('Reporte de Usuarios');
            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');
            $excel->setDescription('Total de usuarios dentro la empresa');
            foreach ($usuarios as $usuario) {
                $excel->sheet($usuario->first_name.' '.$usuario->last_name, function($sheet) use($usuario){
                    $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
                                    ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
                                    ->join('categories', 'categories.id','=','properties.category_id')
                                    ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
                                    ->join('states','states.id','=','properties.state_id')
                                    ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                                            'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                                            'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
                                    ->where('properties.user_id','=',$usuario->id)->get();
                                    //dd($properties);

                            $sheet->setStyle(array(
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  10
                        )
                    ));
                    $sheet->mergeCells('B2:O2');
                    $sheet->mergeCells('B3:O3');
                    $sheet->mergeCells('B4:O4');
                    $sheet->mergeCells('B5:O5');

                    $date = Carbon::now();
                    $fecha = $date->format('d-m-y');
                    $usuarioauth = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                    $objDrawing->setCoordinates('C3');
                    $objDrawing->setWorksheet($sheet);
                    
                    //$sheet->setBorder('A1:AN1', 'thin');
                    $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','','',''));
                    $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES REGISTRADOS', '', '', '', '','','','','','','','','',''));
                    $sheet->row(4, array('', $fecha, '', '', '', '','','','','','','','','',''));
                    $sheet->row(5, array('','Usuario '.$usuarioauth, '', '', '', '','','','','','','','','',''));
                    $sheet->cells('B2:O2', function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontColor('#ffffff');
                        $cells->setAlignment('center');                    
                        $cells->setFontSize(20);
                        //$cells->setSize(15);
                    });
                    $sheet->cells('B3:O3', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });
                    $sheet->cells('B4:O4', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });
                    $sheet->cells('B5:O5', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });  
                    //$sheet->fromArray($properties);
                    $sheet->setBorder('B7:O7', 'thin');
                    $sheet->cells('B7:O7', function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontColor('#ffffff');
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Calibri');
                        $cells->setFontSize(10);
                    });
                    $sheet->mergeCells('H7:I7');
                    $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','ESTADO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                    
                    $sheet->fromModel($properties, null, 'B8', false, false);
                    $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                    ->where('properties.user_id','=',$usuario->id)->get();
                        $total = 0;
                        $totalofertas = 0;
                        $totalcomisones = 0;
                        foreach ($preciosventas as $precio) {
                            $total = $total+$precio->sale_price;
                            $totalofertas = $totalofertas+$precio->offer_price;
                            $totalcomisones = $totalcomisones+$precio->comission;
                        }                
                    
                        $total= number_format($total,2);
                        $totalofertas = number_format($totalofertas,2);
                        $totalcomisones = number_format($totalcomisones,2);
                    $fintabla = count($properties)+8;
                    $sheet->row($fintabla,array('','','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                    $sheet->cells('B'.$fintabla.':O'.$fintabla, function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontColor('#ffffff');
                        
                        $cells->setFontFamily('Calibri');
                        $cells->setFontSize(10);
                    });

                    $range = 'B8:O'.$fintabla;
                    $sheet->cells($range, function($cells) {
                          $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    });

                });
            }
        })->download('xls');
    }

    public function reporteusuariovendido(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m');

        $usuarios = User::join('types_users', 'types_users.id','=','users.type_user_id')
                    ->select('users.id','users.first_name','users.last_name','types_users.name')->get();
       // dd($usuarios);

        Excel::create('Reporte Usuarios', function($excel) use($usuarios, $datoexacto){
            $excel->setTitle('Reporte de Usuarios');
            $excel->setCreator('Orion Bienes Raices')
                  ->setCompany('Orion');
            $excel->setDescription('Total de usuarios dentro la empresa');
            foreach ($usuarios as $usuario) {
                $excel->sheet($usuario->first_name.' '.$usuario->last_name, function($sheet) use($usuario, $datoexacto){
                    $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
                                    ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
                                    ->join('categories', 'categories.id','=','properties.category_id')
                                    ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
                                    ->join('states','states.id','=','properties.state_id')
                                    ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
                                            'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
                                            'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
                                    ->where('properties.user_id','=',$usuario->id)->where('states.name','=','vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                                    //dd($properties);

                            $sheet->setStyle(array(
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  10
                        )
                    ));
                    $sheet->mergeCells('B2:O2');
                    $sheet->mergeCells('B3:O3');
                    $sheet->mergeCells('B4:O4');
                    $sheet->mergeCells('B5:O5');

                    $date = Carbon::now();
                    $fecha = $date->format('d-m-y');
                    $usuarioauth = \Auth::user()->first_name.' '.\Auth::user()->last_name;

                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('images/menu/icono.png')); //your image path
                    $objDrawing->setCoordinates('C3');
                    $objDrawing->setWorksheet($sheet);
                    
                    //$sheet->setBorder('A1:AN1', 'thin');
                    $sheet->row(2, array('','ORION BIENES RAICES', '', '', '', '','','','','','','','','',''));
                    $sheet->row(3, array('','LISTA TOTAL DE INMUEBLES VENDIDOS DE LA FECHA: '.$datoexacto, '', '', '', '','','','','','','','','',''));
                    $sheet->row(4, array('',' del '.$usuario->name.' '.$usuario->first_name.' '.$usuario->last_name.' Fecha de descarga: '.$fecha, '', '', '', '','','','','','','','','',''));
                    //$sheet->row(5, array('','Usuario '.$usuarioauth, '', '', '', '','','','','','','','','',''));
                    $sheet->cells('B2:O2', function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontColor('#ffffff');
                        $cells->setAlignment('center');                    
                        $cells->setFontSize(20);
                        //$cells->setSize(15);
                    });
                    $sheet->cells('B3:O3', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });
                    $sheet->cells('B4:O4', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });
                    /*$sheet->cells('B5:O5', function($cells){
                        
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Arial Black');
                        $cells->setFontSize(12);
                        //$cells->setSize(15);
                    });*/  
                    //$sheet->fromArray($properties);
                    $sheet->setBorder('B7:O7', 'thin');
                    $sheet->cells('B7:O7', function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontColor('#ffffff');
                        $cells->setAlignment('center');
                        $cells->setFontFamily('Calibri');
                        $cells->setFontSize(10);
                    });
                    $sheet->mergeCells('H7:I7');
                    $sheet->row(7,array('','ID','FECHA','ZONA','CALLE','CATEGORIA','TIPO','NOMBRES DUEÑO','','TELEF DUEÑO','CEL DUEÑO','ESTADO','PRECIO VENTA', 'PRECIO OFERTA', 'COMISIÓN'));
                    
                    $sheet->fromModel($properties, null, 'B8', false, false);
                    $preciosventas= Property::join('states','states.id','=','properties.state_id')->select('sale_price','offer_price','comission')
                    ->where('properties.user_id','=',$usuario->id)->where('states.name','=','vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
                        $total = 0;
                        $totalofertas = 0;
                        $totalcomisones = 0;
                        foreach ($preciosventas as $precio) {
                            $total = $total+$precio->sale_price;
                            $totalofertas = $totalofertas+$precio->offer_price;
                            $totalcomisones = $totalcomisones+$precio->comission;
                        }                
                    
                        $total= number_format($total,2);
                        $totalofertas = number_format($totalofertas,2);
                        $totalcomisones = number_format($totalcomisones,2);
                    $fintabla = count($properties)+8;
                    $fintablaganancia = $fintabla+1;
                    $sheet->row($fintabla,array('','','','','','','','','','','','Totales',$total,$totalofertas,$totalcomisones));
                    $sheet->row($fintablaganancia, array('','','','','','','','','','','','Total Ganancia','','',$totalcomisones));
                    $sheet->cells('B'.$fintabla.':O'.$fintabla, function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontColor('#ffffff');
                        
                        $cells->setFontFamily('Calibri');
                        $cells->setFontSize(10);
                    });

                    $sheet->cells('B'.$fintablaganancia.':O'.$fintablaganancia, function($cells){
                        $cells->setBackground('#000000');
                        $cells->setFontColor('#ffffff');
                        
                        $cells->setFontFamily('Calibri');
                        $cells->setFontSize(10);
                    });

                    $range = 'B8:O'.$fintabla;
                    $sheet->cells($range, function($cells) {
                          $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    });

                });
            }
        })->download('xls');
    }

    /*REPORTE USUARIO VENDIDO PDF*/
    public function reporteusuariovendidopdf(Request $request)
    {
        $date = $request->date;
        $datebus = new Carbon($date);
        $datoexacto = $datebus->format('y-m');

        $usuarios = User::all();
        // foreach ($usuarios as $usuario) {                
        //             $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
        //                             ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
        //                             ->join('categories', 'categories.id','=','properties.category_id')
        //                             ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
        //                             ->join('states','states.id','=','properties.state_id')
        //                             ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
        //                                     'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
        //                                     'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
        //                             ->where('properties.user_id','=',$usuario->id)->where('states.name','=','vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        //                             //dd($properties);
        // }
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
        $pdf = PDF::loadView('admin.pdf.pdfusuariovendidos',['usuarios'=>$usuarios,'usuarioadmin'=>$usuario,'date'=>$datoexacto]);
        return $pdf->stream('Reporte Vendidos por Usuario.pdf');

    }
    /*END REPORTE USUARIO VENDIDO PDF*/

/*REPORTE TOTAL GENERAL POR USUARIO*/

    public function reporteusuariototalpdf()
    {   
        $date = Carbon::now();
        $fecha = $date->format('d-m-y');
        $usuarios = User::all();
        // foreach ($usuarios as $usuario) {                
        //             $properties = Property::join('zones', 'zones.id', '=', 'properties.zone_id')
        //                             ->join('owners_currents', 'owners_currents.id', '=', 'properties.owner_current_id')
        //                             ->join('categories', 'categories.id','=','properties.category_id')
        //                             ->join('types_properties', 'types_properties.id','=','properties.type_property_id')
        //                             ->join('states','states.id','=','properties.state_id')
        //                             ->select('properties.id','properties.admission_date','zones.name as nombrezona','properties.street','categories.name as nombrecategoria',
        //                                     'types_properties.name as nombretipo','owners_currents.first_name as nombreprop','owners_currents.last_name as apellidoprop',
        //                                     'owners_currents.phone','owners_currents.cell_phone','states.name','properties.sale_price','properties.offer_price','properties.comission')
        //                             ->where('properties.user_id','=',$usuario->id)->where('states.name','=','vendido')->where('properties.admission_date','LIKE','%'.$datoexacto.'%')->get();
        //                             //dd($properties);
        // }
        $usuario = \Auth::user()->first_name.' '.\Auth::user()->last_name;
        $pdf = PDF::loadView('admin.pdf.pdfusuariototal',['usuarios'=>$usuarios,'usuarioadmin'=>$usuario,'date'=>$fecha]);
        return $pdf->stream('Reporte Vendidos por Usuario.pdf');
    }
/*END REPORTE TOTAL REGISTRADO POR USUARIO*/
    public function reporteclientes()
    {
        dd('REPORTES CLIENTE');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
