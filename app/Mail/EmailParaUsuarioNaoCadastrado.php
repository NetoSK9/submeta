<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailParaUsuarioNaoCadastrado extends Mailable
{
    use Queueable, SerializesModels;
    public $nomeUsuarioPai;
    public $nomeTrabalho;
    public $nomeFuncao;
    public $nomeEvento;
    public $senhaTemporaria;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $nomeUsuarioPai, String $nomeTrabalho, String $nomeFuncao, String $nomeEvento, String $senhaTemporaria,  String $subject)
    {
      $this->nomeUsuarioPai  = $nomeUsuarioPai;
      $this->nomeTrabalho    = $nomeTrabalho;
      $this->nomeFuncao      = $nomeFuncao;
      $this->nomeEvento      = $nomeEvento;
      $this->senhaTemporaria = $senhaTemporaria;
      $this->subject         = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->nomeFuncao != 'Participante'){
            $file = public_path().'/ModeloFormularioAvaliadorExternoPIBIC.docx';
            return $this->from('lmtsteste@gmail.com', 'Submeta - LMTS')
                        ->subject($this->subject)
                        ->view('emails.usuarioNaoCadastrado')
                        ->with([
                            'nomeUsuarioPai' => $this->nomeUsuarioPai,
                            'nomeTrabalho' => $this->nomeTrabalho,    
                            'nomeFuncao' => $this->nomeFuncao,      
                            'nomeEvento' => $this->nomeEvento,      
                            'senhaTemporaria' => $this->senhaTemporaria
                            
                        ])->attach($file, [
                            'as' => 'ModeloFormularioAvaliadorExternoPIBIC.docx',
                            'mime' => 'application/docx',
                        ]);
        }else{
            return $this->from('lmtsteste@gmail.com', 'Submeta - LMTS')
                        ->subject($this->subject)
                        ->view('emails.usuarioNaoCadastrado')
                        ->with([
                            'nomeUsuarioPai' => $this->nomeUsuarioPai,
                            'nomeTrabalho' => $this->nomeTrabalho,    
                            'nomeFuncao' => $this->nomeFuncao,      
                            'nomeEvento' => $this->nomeEvento,      
                            'senhaTemporaria' => $this->senhaTemporaria
                            
                        ]);
        }
    
    }
}
