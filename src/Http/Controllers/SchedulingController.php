<?php

namespace Dcat\Admin\Extension\Scheduling\Http\Controllers;

use Dcat\Admin\Extension\Scheduling\Scheduling;
use Dcat\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SchedulingController extends Controller
{
    public function index(Content $content)
    {
        $scheduling = new Scheduling();
        return $content
            ->title('任务调度')
            ->description('任务调度列表')
            ->body(view('scheduling::index', [
                'events' => $scheduling->getTasks(),
            ]));
    }


    /**
     * @param Request $request
     *
     * @return array
     */
    public function runEvent(Request $request)
    {
        $scheduling = new Scheduling();

        try {
           $output = $scheduling->runTask($request->get('id'));

            return [
                'status'    => true,
                'message'   => 'success',
                'data'      => $output,
            ];
        } catch (\Exception $e) {
            return [
                'status'    => false,
                'message'   => 'failed',
                'data'      => $e->getMessage(),
            ];
        }
    }
}
