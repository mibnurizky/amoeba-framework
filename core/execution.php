<?php
class Execution{
    public function start($id){
        $app = new App();
        if($app->show_execution_time){
            $session = new Session(true);
            $time = time();

            $data = array();
            $data[$id]['START'] = $time;

            $session->merge('EXECUTION_TIME',$data);
        }
    }

    public function end($id){
        $app = new App();
        if($app->show_execution_time) {
            $session = new Session(true);
            $data = $session->get('EXECUTION_TIME');
            $time = time();

            $end = array();
            $end[$id]['START'] = (!empty($data[$id]['START']) ? $data[$id]['START'] : 0);
            $end[$id]['END'] = $time;

            $session->merge('EXECUTION_TIME', $end);
        }
    }

    public function calculate($id){
        $session = new Session(true);
        $data = $session->get('EXECUTION_TIME');

        $start = (!empty($data[$id]['START']) ? $data[$id]['START'] : 0);
        $end = (!empty($data[$id]['END']) ? $data[$id]['END'] : 0);
        if($end < $start){
            $difference = 0;
        }
        else{
            $difference = $end - $start;
        }

        $return = array(
            'START' => $start,
            'END' => $end,
            'DIFF' => $difference
        );

        return $return;
    }

    public function calculate_all(){
        $session = new Session(true);
        $data = $session->get('EXECUTION_TIME');

        $arData = array();
        foreach($data as $key => $row){
            $start = (!empty($data[$key]['START']) ? $data[$key]['START'] : 0);
            $end = (!empty($data[$key]['END']) ? $data[$key]['END'] : 0);
            $difference = $end - $start;
            if($end < $start){
                $difference = 0;
            }
            else{
                $difference = $end - $start;
            }

            $arData[$key] = array(
                'START' => $start,
                'END' => $end,
                'DIFF' => $difference
            );
        }

        return $arData;
    }
}
?>