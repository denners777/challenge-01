<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * model Clientes_Model
 * @link        https://github.com/denners777/challenge-01
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
class Clientes_Model extends CI_Model {

    /**
     * id
     * @var type 
     */
    public $id;
    
    /**
     * cpf
     * @var type 
     */
    public $cpf;
    
    /**
     * senha
     * @var type 
     */
    public $senha;
    
    /**
     * nome
     * @var type 
     */
    public $nome;
    
    /**
     * telefone
     * @var type 
     */
    public $telefone;
    
    /**
     * email
     * @var type 
     */
    public $email;
    
    /**
     * dt_nasc
     * @var type 
     */
    public $dt_nasc;
    
    /**
     * cep
     * @var type 
     */
    public $cep;
    
    /**
     * logr
     * @var type 
     */
    public $logr;
    
    /**
     * numero
     * @var type 
     */
    public $numero;
    
    /**
     * compl
     * @var type 
     */
    public $compl;
    
    /**
     * bairro
     * @var type 
     */
    public $bairro;
    
    /**
     * cidade
     * @var type 
     */
    public $cidade;
    
    /**
     * uf
     * @var type 
     */
    public $uf;
    /**
     * rg
     * @var type 
     */
    
    public $rg;
    
    /**
     * dt_exp_rg
     * @var type 
     */
    public $dt_exp_rg;
    
    /**
     * org_exp_rg
     * @var type 
     */
    public $org_exp_rg;
    
    /**
     * est_civil
     * @var type 
     */
    public $est_civil;
    
    /**
     * categoria
     * @var type 
     */
    public $categoria;
    
    /**
     * empresa
     * @var type 
     */
    public $empresa;
    
    /**
     * profissao
     * @var type 
     */
    public $profissao;
    
    /**
     * renda_bruta
     * @var type 
     */
    public $renda_bruta;
    
    /**
     * createin
     * @var type 
     */
    public $createin;
    
    /**
     * updatein
     * @var type 
     */
    public $updatein;
    

    /**
     * construct
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * function getAll
     * @return type
     */
    public function getAll() {
        $query = $this->db->get('clientes');

        if (empty($query->result())) {
            return $query->result();
        }

        $result = $this->formatResult($query->result());
        return $result;
    }

    /**
     * function get
     * @param type $param
     * @return type
     */
    public function get($param) {

        if (is_array($param)) {
            $parameter = $param;
        } else {
            $parameter = ['id' => $param];
        }

        $this->db->where($parameter);
        $query = $this->db->get('clientes');

        if (empty($query->result())) {
            return $query->result();
        }

        $result = $this->formatResult($query->result());
        return $result;
    }

    /**
     * function save
     * @param type $post
     * @return type
     */
    public function save($post) {
        $this->setValues($post);
        if (is_null($this->getId())) {
            $this->validator();
            $this->setCreatein(date('Y-m-d h:i:s'));
            return $this->db->insert('clientes', $this);
        } else {
            $this->validator(true);

            $createIn = $this->get($this->id)[0]->createin;
            $aux = explode(' ', $createIn);
            $createIn = implode('-', array_reverse(explode('/', $aux[0]))) . ' ' . $aux[1];
            $this->setCreatein($createIn);

            $this->setUpdatein(date('Y-m-d h:i:s'));

            return $this->db->update('clientes', $this, ['id' => $this->id]);
        }
    }

    /**
     * function delete
     * @param type $param
     * @return type
     */
    public function delete($param) {
        return $this->db->delete('clientes', $param);
    }

    /**
     * function setValues
     * @param type $post
     */
    private function setValues($post) {
        foreach ($post as $key => $value) {
            $property = 'set' . ucfirst($key);
            $this->$property($value);
        }
    }

    /**
     * function formatResult
     * @param type $result
     * @return type
     */
    private function formatResult($result) {

        foreach ($result as $key => $value) {
            $result[$key]->senha = null;
            $result[$key]->dt_nasc = implode('/', array_reverse(explode('-', $result[$key]->dt_nasc)));
            if (!empty($result[$key]->dt_exp_rg)) {
                $result[$key]->dt_exp_rg = implode('/', array_reverse(explode('-', $result[$key]->dt_exp_rg)));
            }
            if (!empty($result[$key]->renda_bruta)) {
                $result[$key]->renda_bruta = 'R$ ' . number_format($result[$key]->renda_bruta, 2, ',', '.');
            }
            if (!empty($result[$key]->createin)) {
                $aux = explode(' ', $result[$key]->createin);
                $result[$key]->createin = implode('/', array_reverse(explode('-', $aux[0]))) . ' ' . $aux[1];
            }
            if (!empty($result[$key]->updatein)) {
                $aux = explode(' ', $result[$key]->updatein);
                $result[$key]->updatein = implode('/', array_reverse(explode('-', $aux[0]))) . ' ' . $aux[1];
            }
        }

        return $result;
    }

    /**
     * function validator
     * @param type $edit
     * @throws Exception
     */
    private function validator($edit = false) {
        $config = [
            [
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'O preenchimento do campo %s é obrigatório.',
                    'valid_email' => '%s não parece um e-mail válido.',
                ],
            ],
            [
                'field' => 'dt_nasc',
                'label' => 'Data de Nascimento',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'cep',
                'label' => 'CEP',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'logr',
                'label' => 'Logradouro',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'numero',
                'label' => 'Número',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'bairro',
                'label' => 'Bairro',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'uf',
                'label' => 'Estado',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
            [
                'field' => 'est_civil',
                'label' => 'Estado Civil',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatório.'],
            ],
        ];
        if (!$edit) {
            $config[] = [
                'field' => 'senha',
                'label' => 'Senha',
                'rules' => 'required',
                'errors' => ['required' => 'O preenchimento do campo %s é obrigatória.'],
            ];
            $config[] = [
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'is_unique[clientes.cpf]',
                'errors' => ['is_unique' => 'Este %s já está cadastrado.'],
            ];
            $config[] = [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'is_unique[clientes.email]',
                'errors' => ['is_unique' => 'Este %s já está cadastrado.',],
            ];
        }

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
        }
    }

    /**
     * function getId
     * @return type
     */
    public function getId() {
        return $this->id;
    }

    /**
     * function getCpf
     * @return type
     */
    public function getCpf() {
        return $this->cpf;
    }

    /**
     * function getSenha
     * @return type
     */
    public function getSenha() {
        return $this->senha;
    }

    /**
     * function getNome
     * @return type
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * function getTelefone
     * @return type
     */
    public function getTelefone() {
        return $this->telefone;
    }

    /**
     * function getEmail
     * @return type
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * function getDt_nasc
     * @return type
     */
    public function getDt_nasc() {
        return $this->dt_nasc;
    }

    /**
     * function getCep
     * @return type
     */
    public function getCep() {
        return $this->cep;
    }

    /**
     * function getLogr
     * @return type
     */
    public function getLogr() {
        return $this->logr;
    }

    /**
     * function getNumero
     * @return type
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * function getCompl
     * @return type
     */
    public function getCompl() {
        return $this->compl;
    }

    /**
     * function getBairro
     * @return type
     */
    public function getBairro() {
        return $this->bairro;
    }

    /**
     * function getCidade
     * @return type
     */
    public function getCidade() {
        return $this->cidade;
    }

    /**
     * function getUf
     * @return type
     */
    public function getUf() {
        return $this->uf;
    }

    /**
     * function getRg
     * @return type
     */
    public function getRg() {
        return $this->rg;
    }

    /**
     * function getDt_exp_rg
     * @return type
     */
    public function getDt_exp_rg() {
        return $this->dt_exp_rg;
    }

    /**
     * function getOrg_exp_rg
     * @return type
     */
    public function getOrg_exp_rg() {
        return $this->org_exp_rg;
    }

    /**
     * function getEst_civil
     * @return type
     */
    public function getEst_civil() {
        return $this->est_civil;
    }

    /**
     * function getCategoria
     * @return type
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * function getEmpresa
     * @return type
     */
    public function getEmpresa() {
        return $this->empresa;
    }

    /**
     * function getProfissao
     * @return type
     */
    public function getProfissao() {
        return $this->profissao;
    }

    /**
     * function getRenda_bruta
     * @return type
     */
    public function getRenda_bruta() {
        return $this->renda_bruta;
    }

    /**
     * function getCreatein
     * @return type
     */
    public function getCreatein() {
        return $this->createin;
    }

    /**
     * function getUpdatein
     * @return type
     */
    public function getUpdatein() {
        return $this->updatein;
    }

    /**
     * function setId
     * @param type $id
     * @return \Clientes_Model
     */
    public function setId($id) {
        if (empty($id)) {
            $this->id = null;
        } else {
            $this->id = (int) $id;
        }
        return $this;
    }

    /**
     * function setCpf
     * @param type $cpf
     * @return \Clientes_Model
     */
    public function setCpf($cpf) {
        $this->cpf = addslashes($cpf);
        return $this;
    }

    /**
     * function setSenha
     * @param type $senha
     * @return \Clientes_Model
     */
    public function setSenha($senha) {
        if (empty($senha)) {
            $this->senha = $this->get($this->id)[0]->senha;
        } else {
            $this->senha = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
        }
        return $this;
    }

    /**
     * function setNome
     * @param type $nome
     * @return \Clientes_Model
     */
    public function setNome($nome) {
        $this->nome = addslashes($nome);
        return $this;
    }

    /**
     * function setTelefone
     * @param type $telefone
     * @return \Clientes_Model
     */
    public function setTelefone($telefone) {
        $this->telefone = addslashes($telefone);
        return $this;
    }

    /**
     * function setEmail
     * @param type $email
     * @return \Clientes_Model
     */
    public function setEmail($email) {
        $this->email = addslashes($email);
        return $this;
    }

    /**
     * function setDt_nasc
     * @param type $dt_nasc
     * @return \Clientes_Model
     */
    public function setDt_nasc($dt_nasc) {
        if (!empty($dt_nasc)) {
            $this->dt_nasc = implode('-', array_reverse(explode('/', $dt_nasc)));
        }
        return $this;
    }

    /**
     * function setCep
     * @param type $cep
     * @return \Clientes_Model
     */
    public function setCep($cep) {
        $this->cep = addslashes($cep);
        return $this;
    }

    /**
     * function setLogr
     * @param type $logr
     * @return \Clientes_Model
     */
    public function setLogr($logr) {
        $this->logr = addslashes($logr);
        return $this;
    }

    /**
     * function setNumero
     * @param type $numero
     * @return \Clientes_Model
     */
    public function setNumero($numero) {
        $this->numero = addslashes($numero);
        return $this;
    }

    /**
     * function setCompl
     * @param type $compl
     * @return \Clientes_Model
     */
    public function setCompl($compl) {
        $this->compl = addslashes($compl);
        return $this;
    }

    /**
     * function setBairro
     * @param type $bairro
     * @return \Clientes_Model
     */
    public function setBairro($bairro) {
        $this->bairro = addslashes($bairro);
        return $this;
    }

    /**
     * function setCidade
     * @param type $cidade
     * @return \Clientes_Model
     */
    public function setCidade($cidade) {
        $this->cidade = addslashes($cidade);
        return $this;
    }

    /**
     * function setUf
     * @param type $uf
     * @return \Clientes_Model
     */
    public function setUf($uf) {
        $this->uf = addslashes($uf);
        return $this;
    }

    /**
     * function setRg
     * @param type $rg
     * @return \Clientes_Model
     */
    public function setRg($rg) {
        $this->rg = addslashes($rg);
        return $this;
    }

    /**
     * function setDt_exp_rg
     * @param type $dt_exp_rg
     * @return \Clientes_Model
     */
    public function setDt_exp_rg($dt_exp_rg) {
        if (!empty($dt_exp_rg)) {
            $this->dt_exp_rg = implode('-', array_reverse(explode('/', $dt_exp_rg)));
        }
        return $this;
    }

    /**
     * function setOrg_exp_rg
     * @param type $org_exp_rg
     * @return \Clientes_Model
     */
    public function setOrg_exp_rg($org_exp_rg) {
        $this->org_exp_rg = addslashes($org_exp_rg);
        return $this;
    }

    /**
     * function setEst_civil
     * @param type $est_civil
     * @return \Clientes_Model
     */
    public function setEst_civil($est_civil) {
        $this->est_civil = addslashes($est_civil);
        return $this;
    }

    /**
     * function setCategoria
     * @param type $categoria
     * @return \Clientes_Model
     */
    public function setCategoria($categoria) {
        $this->categoria = addslashes($categoria);
        return $this;
    }

    /**
     * function setEmpresa
     * @param type $empresa
     * @return \Clientes_Model
     */
    public function setEmpresa($empresa) {
        $this->empresa = addslashes($empresa);
        return $this;
    }

    /**
     * function setProfissao
     * @param type $profissao
     * @return \Clientes_Model
     */
    public function setProfissao($profissao) {
        $this->profissao = addslashes($profissao);
        return $this;
    }

    /**
     * function setRenda_bruta
     * @param type $renda_bruta
     * @return \Clientes_Model
     */
    public function setRenda_bruta($renda_bruta) {
        if (!empty($renda_bruta)) {
            $this->renda_bruta = (float) str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $renda_bruta)));
        }
        return $this;
    }

    /**
     * function setCreatein
     * @param type $createin
     * @return \Clientes_Model
     */
    public function setCreatein($createin) {
        $this->createin = $createin;
        return $this;
    }

    /**
     * function setUpdatein
     * @param type $updatein
     * @return \Clientes_Model
     */
    public function setUpdatein($updatein) {
        $this->updatein = $updatein;
        return $this;
    }

}
