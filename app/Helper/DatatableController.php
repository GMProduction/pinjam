<?php

namespace App\Helper;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Psr7\build_query;

class DatatableController extends Controller
{

    protected $query;
    protected $isDTJoin = false;
    protected $select;
    protected $requiredWhere;
    protected $actionButton;
    protected $controller;
    protected $formatImage;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatableServer($model, $where = null)
    {
        $tb          = $model;
        $this->query = DB::table($tb, 'a');
        if ($this->isDTJoin) {
            $this->dtJoin();
        }
        $select[] = 'a.id';
        foreach ($this->select as $sel) {
//            if (is_array($sel['select'])) {
//                $select = array_merge($select, $sel['select']);
            $select[] = $sel['select'];
//            }
        }
        $this->query
            ->select($select);
        if ($this->requiredWhere) {
            foreach ($this->requiredWhere as $wer) {
                $this->query->where($wer['column'], $wer['operator'], $wer['value']);
            }
        }
        $this->query->get();

        return $this->db($this->query);

    }

    public function dtJoin()
    {

    }

    /**
     * @param $query
     *
     * @return mixed
     * @throws \Exception
     */
    public function db($query)
    {

        $dt  = DataTables::of($query);
        $raw = [];

        if ($this->actionButton) {
            $dt->addColumn(
               'actionButton',
                function ($model) {
                   $button = '';
                    foreach ($this->actionButton as $btn) {
                        $button .= $this->button($model, $btn['id'], $btn['class'], $btn['text']);
                    }
                    return $button;
                }
            );
            $raw[] = 'actionButton';

        }

        foreach ($this->select as $sel) {
            if ($sel['format']) {
                $dt->editColumn(
                    $sel['select'],
                    function ($model) {
                        $img = '<img src="/images/no-image.png" height="70"  />';
                        if ($model->image) {
                            $img = '<a href="#!" data-src="'.$model->image.'" onclick="openImg(this)"><img src="'.$model->image.'" height="70" onerror="this.onerror=null; this.src=\'/images/no-image.png\'" /></a>';
                        }

                        return $img;
                    }
                );
                $raw[] = $sel['select'];
            }
        }
        $dt->rawColumns($raw);

        $dt = $dt->make(true);

        return $dt;
    }

    /**
     * @param $model
     * @param $id
     * @param $class
     * @param $txt
     *
     * @return string
     */
    public function button($model, $id, $class, $txt)
    {
        $dataAttr = '';
        foreach ($model as $key => $m) {
            $dataAttr .= ' data-'.$key.'="'.$m.'"';
        }

        return '<a class="btn btn-sm '.$class.'" style="border-radius: 50px" id="'.$id.'Data" '.$dataAttr.'>'.$txt.'</a>';
    }

    /**
     * @return string
     */
    public function editButton($model)
    {
        $dataAttr = '';
        foreach ($model as $key => $m) {
            $dataAttr .= ' data-'.$key.'="'.$m.'"';
        }

        return '<a class="btn btn-primary btn-sm" id="editData" '.$dataAttr.'><i class="mdi mdi-file-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function deleteButton($model)
    {
        $dataAttr = '';
        foreach ($model as $key => $m) {
            $dataAttr .= ' data-'.$key.'="'.$m.'"';
        }

        return '<a class="btn btn-primary btn-sm" id="deleteData" '.$dataAttr.'><i class="mdi mdi-delete"></i></a>';
    }
}
