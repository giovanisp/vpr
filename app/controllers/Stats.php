<?php

class Stats extends AppController
{

    public static function by_region()
    {
        $cache = self::getParam('cache');

        self::setPageName("Acompanhamento da Votação");
        self::setPageSubName("Parciais atualizadas por tipo de mídia online");

        $values = CacheFS::get('statsSummary');

        $votacao = Votacao::findCachedMostRecent();
        $id_votacao = $votacao->getIdVotacao();

        if (is_null($values) || $cache == 'off') {
            $meios_votacao = array();

            $eleitores = array('totais' => array());
            $votos = array('totais' => array());

            $cidadaosPorRegiaoMeioVotacao = Stat::findCidadaosPorRegiaoMeioVotacao(compact('id_votacao'));
            foreach ($cidadaosPorRegiaoMeioVotacao as $stat) {
                $meio = $stat['nm_meio_votacao'];
                $regiao = $stat['nm_regiao'];
                $total = $stat['total'];

                $meios_votacao[$meio] = 1;
                @$eleitores[$regiao][$meio] = $total;
                @$eleitores[$regiao]['total'] += $total;
                @$eleitores['totais'][$meio] += $total;
            }

            $votosPorRegiaoMeioVotacao = Stat::findVotosPorRegiaoMeioVotacao(compact('id_votacao'));
            foreach ($votosPorRegiaoMeioVotacao as $stat) {
                $meio = $stat['nm_meio_votacao'];
                $regiao = $stat['nm_regiao'];
                $total = $stat['total'];

                $meios_votacao[$meio] = 1;
                @$votos[$regiao][$meio] = $total;
                @$votos[$regiao]['total'] += $total;
                @$votos['totais'][$meio] += $total;
            }
            $meios_votacao = array_keys($meios_votacao);

            $date = new DateTime();

            $values = compact('meios_votacao', 'eleitores', 'votos', 'date');

            CacheFS::set('statsSummary', $values);
            $values = CacheFS::get('statsSummary');
        }

        self::render($values);
    }

    public static function summary()
    {
        self::setPageName("Acompanhamento da Votação");
        self::setPageSubName("Parciais atualizadas por tipo de mídia online");

        $votacao = Votacao::findCachedMostRecent();
        $id_votacao = $votacao->getIdVotacao();

        $totalVotos = reset(Stat::findByQtdVotos(compact('id_votacao')));
        $totalVotosByMeioVotacaoRaw = Stat::findByQtdVotosByMeioVotacao(compact('id_votacao'));

        $totalCidadaos = reset(Stat::findByQtdCidadaos(compact('id_votacao')));
        $totalCidadaosByMeioVotacaoRaw = Stat::findByQtdCidadaosByMeioVotacao(compact('id_votacao'));

        $totalVotosByMeioVotacao = array();
        $totalCidadaosByMeioVotacao = array();
        $meios_votacao = array();
        foreach ($totalVotosByMeioVotacaoRaw as $stat) {
            $meios_votacao[$stat['nm_meio_votacao']] = 1;
            $totalVotosByMeioVotacao[$stat['nm_meio_votacao']] = $stat['total'];
        }
        foreach ($totalCidadaosByMeioVotacaoRaw as $stat) {
            $meios_votacao[$stat['nm_meio_votacao']] = 1;
            $totalCidadaosByMeioVotacao[$stat['nm_meio_votacao']] = $stat['total'];
        }
        $meios_votacao = array_keys($meios_votacao);

        // Poll data
        $polls = Stat::findPollsByVotacaoId($votacao->getIdVotacao());

        $values = compact('totalVotos', 'totalVotosByMeioVotacao', 'totalCidadaos', 'totalCidadaosByMeioVotacao', 'meios_votacao', 'polls');

        self::render($values);
    }

    public static function liveChart()
    {
        self::setPageName("Evolução da Votação");
        self::setPageSubName("Estatísticas em tempo real");

        $dataUrl = HTMLHelper::url(array('controller' => 'Stats', 'action' => 'chartData'));

        $values = compact('dataUrl');
        self::render($values);
    }

    public static function chartData()
    {
        $cache = self::getParam('cache');
        $values = CacheFS::get('chartData');

        if (is_null($values) || $cache == 'off') {
            $votacao = Votacao::findCachedMostRecent();
            $id_votacao = $votacao->getIdVotacao();
            $newVotesPerMinute = Stat::findNewVotesPerMinuteByVotacaoId($id_votacao);

            $values = compact('newVotesPerMinute');
            
            CacheFS::set('chartData', $values, 20 * SECOND);
            $values = CacheFS::get('chartData');
            $values['cacheHit'] = false;
            error_log("Cache miss");
        } else {
            $values['cacheHit'] = true;
            error_log("Cache HIT");
        }
        
        self::render($values);
    }

}
