<?php

namespace App\Services;

class JogosService
{
    private $quantidadeDeDezenas = 0;
    private $resultado;
    private $totalJogos = 0;
    private $jogos;

    public function __construct($quantidadeDeDezenas, $totalJogos)
    {
        $this->quantidadeDeDezenas  = $quantidadeDeDezenas;
        if (in_array($this->quantidadeDeDezenas, [6, 7, 8, 9, 10])) {
            $this->totalJogos           = $totalJogos;
        }
    }

    public function gerar(): void
    {
        $i = 1;
        $jogos = null;
        while ($i <= $this->totalJogos) {
            $jogos[] = $this->gerarJogos();
            $i++;
        }

        $this->jogos = $jogos;
    }

    private function gerarJogos(): array
    {
        $numeros = array();

        $i = 1;
        while ($i <= $this->quantidadeDeDezenas) {
            $numero = rand(1, 60);
            if (!in_array($numero, $numeros)) {
                $numeros[] = $numero;
                ++$i;
            }
        }
        sort($numeros);

        return $numeros;
    }

    public function sortear(): void
    {
        $numeros = array();

        $i = 1;
        while ($i <= $this->quantidadeDeDezenas) {
            $numero = rand(1, 60);
            if (!in_array($numero, $numeros)) {
                $numeros[] = $numero;
                ++$i;
            }
        }
        sort($numeros);

        $this->resultado = $numeros;
    }

    public function conferir(): string
    {
        $this->gerar();
        if (isset($this->jogos)) {

            $this->sortear();
            $numeroSorteado = "";
            foreach ($this->resultado as $numero) {
                $numeroSorteado .= $numero . ",";
            }

            $table = "
                <table class='table'><thead class='thead-dark'>
                    <tr>
                        <th scope='col'><center>Sorteado</center></th>
                        <th scope='col'>" . $numeroSorteado . "</th>
                    </tr>
                    <tr>
                        <th scope='col'><center>Jogo(" . count($this->jogos) . ")</center></th>
                        <th scope='col'>acertos</th>
                    </tr>
                </thead><tbody>
            ";

            foreach ($this->jogos as $jogo) {
                $i = 0;
                foreach ($jogo as $numero) {
                    if (in_array($numero, $this->resultado)) {
                        $i++;
                    }
                }
                $f = "";
                foreach ($jogo as $numero) {
                    $f .= $numero . ",";
                }

                $table .= "
                    <tr>
                        <th scope='row'><center>{$f}</center></th>
                        <th scope='row'>{$i}</th>
                    </tr>
                ";
            }

            return $table .= "</tbody></table>";
        } else {
            return "<center><b><p>a quantidade de dezenas precisa ser um numero entre 6 e 10! atualmente é {$this->quantidadeDeDezenas}</p></b></center>";
        }
    }

    /**
     * Get the value of quantidadeDeDezenas
     */
    public function getQuantidadeDeDezenas()
    {
        return $this->quantidadeDeDezenas;
    }

    /**
     * Set the value of quantidadeDeDezenas
     *
     * @return  self
     */
    public function setQuantidadeDeDezenas($quantidadeDeDezenas)
    {
        $this->quantidadeDeDezenas = $quantidadeDeDezenas;

        return $this;
    }

    /**
     * Get the value of resultado
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set the value of resultado
     *
     * @return  self
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get the value of totalJogos
     */
    public function getTotalJogos()
    {
        return $this->totalJogos;
    }

    /**
     * Set the value of totalJogos
     *
     * @return  self
     */
    public function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;

        return $this;
    }

    /**
     * Get the value of jogos
     */
    public function getJogos()
    {
        return $this->jogos;
    }

    /**
     * Set the value of jogos
     *
     * @return  self
     */
    public function setJogos($jogos)
    {
        $this->jogos = $jogos;

        return $this;
    }
}
