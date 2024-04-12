<?php

    class Veiculo {

        protected $combustivel;
        protected $kmPorLitro;
        protected $posicaoX;
        protected $posicaoY;
        protected $ligado;
        protected $distanciaPercorrida;
        protected $distanciaMaxima;
        protected $nomeVeiculo;
        protected $qtdMovimentos;

        public function __construct($combustivel, $kmPorLitro, $nomeVeiculo) {
            $this->combustivel = $combustivel;
            $this->kmPorLitro = $kmPorLitro;
            $this->posicaoX = 0;
            $this->posicaoY = 0;
            $this->ligado = false;
            $this->distanciaPercorrida = 0;
            $this->nomeVeiculo = $nomeVeiculo;
            $this->atualizarDistanciaMaxima();
            $this->qtdMovimentos = 0;
        }

        public function atualizarDistanciaMaxima(){
            $this->distanciaMaxima = $this->kmPorLitro * $this->combustivel;
        }

        public function ligar() {
            if ($this->combustivel > 0) {
                if(!$this->ligado){
                    $this->ligado = true;
                    echo nl2br("{$this->nomeVeiculo} ligado \n");
                } else {
                    echo nl2br("{$this->nomeVeiculo} já está ligado \n");
                }
            } else {
                echo nl2br("Combustível insuficiente para ligar o {$this->nomeVeiculo}. \n");
            }
        }

        public function desligar() {
            if ($this->ligado) {
                $this->ligado = false;
                echo nl2br("{$this->nomeVeiculo} Desligado \n");
            } else {
                echo nl2br("O {$this->nomeVeiculo} já está desligado. \n");
            }
        }

        public function mover($direcao) {
            if (!$this->ligado) {
                echo nl2br("O {$this->nomeVeiculo} está desligado. Ligue-o antes de mover. \n");
                return;
            }
        
            if ($this->combustivel <= 0) {
                echo nl2br("Combustível insuficiente para mover o {$this->nomeVeiculo}. \n");
                return;
            }
        
            $distanciaAnterior = $this->distanciaPercorrida;
        
            switch ($direcao) {
                case 'cima':
                    echo nl2br("Movendo para cima \n");
                    $this->posicaoY += 1;
                    break;
                case 'baixo':
                    echo nl2br("Movendo para baixo \n");
                    $this->posicaoY -= 1;
                    break;
                case 'esquerda':
                    echo nl2br("Movendo para esquerda \n");
                    $this->posicaoX -= 1;
                    break;
                case 'direita':
                    echo nl2br("Movendo para direita \n");
                    $this->posicaoX += 1;
                    break;
                default:
                    echo nl2br("Direção inválida. Informe uma das seguintes opções: cima, baixo, esquerda ou direita. \n");
                    return;
            }
        
            $distanciaX = abs($this->posicaoX);
            $distanciaY = abs($this->posicaoY);
        
            $this->distanciaPercorrida = $distanciaX + $distanciaY;
        
            if ($this->distanciaPercorrida > $this->distanciaMaxima) {
                echo nl2br("Não é possível percorrer mais do que o limite estabelecido de {$this->distanciaMaxima} km. \n");
                return;
            }
        
            $combustivelConsumido = abs($this->distanciaPercorrida - $distanciaAnterior) / $this->kmPorLitro;
            $this->combustivel -= $combustivelConsumido;
        
            echo nl2br("Combustível gasto: {$combustivelConsumido}L \n");
        
            $this->exibirMensagemCombustivelRestante();

            $this->qtdMovimentos++;
        }                                

        public function exibirMensagemCombustivelRestante() {
            $combustivelRestante = $this->combustivel;

            echo nl2br("Combustível restante: {$combustivelRestante}L \n");
        }

        public function exibirPosicaoAtual() {
            echo nl2br("Posição atual de {$this->nomeVeiculo}: X = {$this->posicaoX}, Y = {$this->posicaoY} \n");
        }

        public function exibirDistanciaPercorrida() {
            echo nl2br("Distância percorrida: {$this->qtdMovimentos}km. \n");
        }
    }

    $carrinho = new Veiculo(10, 5, 'Carrinho');
    $aviaoJato = new Veiculo(30, 2, 'Aviao Jato');
    $helicoptero = new Veiculo(20, 2, 'Helicoptero');
    $navio = new Veiculo(15, 10, 'Navio');
    
    $carrinho->ligar();
    $carrinho->mover('cima');
    $carrinho->mover('esquerda');
    $carrinho->mover('direita');
    $carrinho->mover('direita');
    $carrinho->mover('direita');
    $carrinho->mover('baixo');
    $carrinho->mover('baixo');
    $carrinho->exibirPosicaoAtual();
    $carrinho->desligar();
    $carrinho->exibirDistanciaPercorrida();

    $helicoptero->ligar();
    $helicoptero->mover('cima');
    $helicoptero->mover('cima');
    $helicoptero->mover('esquerda');
    $helicoptero->mover('esquerda');
    $helicoptero->mover('esquerda');
    $helicoptero->mover('baixo');
    $helicoptero->mover('direita');
    $helicoptero->exibirPosicaoAtual();
    $helicoptero->desligar();
    $helicoptero->exibirDistanciaPercorrida();


    $aviaoJato->ligar();
    $aviaoJato->mover('cima');
    $aviaoJato->mover('esquerda');
    $aviaoJato->mover('esquerda');
    $aviaoJato->mover('baixo');
    $aviaoJato->mover('baixo');
    $aviaoJato->mover('baixo');
    $aviaoJato->mover('baixo');
    $aviaoJato->mover('direita');
    $aviaoJato->exibirPosicaoAtual();
    $aviaoJato->desligar();
    $aviaoJato->exibirDistanciaPercorrida();


    $navio->ligar();
    $navio->mover('cima');
    $navio->mover('baixo');
    $navio->mover('direita');
    $navio->mover('esquerda');
    $navio->exibirPosicaoAtual();
    $navio->desligar();
    $navio->exibirDistanciaPercorrida();
?>