<?php

function pullData()
{
    $link = leechLink();
    $pullData = new PullData;
    $query = new Query;

    $counter = 1;
    $data = array();
    // print_r(leechData("http://tryoutunonline.com/soal-41-soal_usbn.html"));
    for($i = 0 ; $i < count($link); $i++)
    {
        echo $link[$i]['url'];
        $hsl = leechData($link[$i]['url']);

        if($hsl != "kosong"){
            $data[] = $hsl;
            echo "\n";
        }
        else{
            $query->insert('link_error',"link='".$link[$i]['url']."'");
            echo "\nkosong\n";
        }
    }

    for($i = 0 ; $i < count($data); $i++)
    {
        $matpel = $pullData->checkMatpel($link[$i]['bidstudi']);
        $pullData->setMatpel($matpel);
        $pullData->setData($data[$i]);
        $pullData->setJenjang($link[$i]['kelas']);
        $pullData->setTipeSoal($link[$i]['judul']);
        $pullData->setToDB();
    }
    // print_r($pullData->getData());
}


