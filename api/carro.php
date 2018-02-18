<?php
class carro

    {
    private $method = "";
    private $id = null;
    private $marca = "";
    private $modelo = "";
    private $ano = 0;
    private $recordID = "";
    const jsonUrl = '../test.json';
    public

    function __construct()
        {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $file = file_get_contents(self::jsonUrl);
        $data = json_decode($file, true);
        if (isset($_SERVER['PATH_INFO']))
            {
            $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
            $this->id = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
            }
          else
            {
            $this->id = false;
            }
        }

    public

    function getID()
        {
        return $this->recordID;
        }

    public

    function run()
        {
        switch ($this->method)
            {
        case 'GET':
            if ($this->id)
                {
                echo "Retorna id";
                }
              else
                {
                $getfile = file_get_contents(self::jsonUrl);
                $jsonfile = json_decode($getfile);
                echo $getfile;
                }

            break;

        case 'PUT':
            if ($this->id)
                {
                $dados = file_get_contents("php://input");
                parse_str($dados);
                $this->marca = $marca;
                $this->ano = $ano;
                $this->modelo = $modelo;
                $resultado = array(
                    'id' => $this->id,
                    'marca' => $this->marca,
                    'ano' => $this->ano,
                    'modelo' => $this->modelo
                );
                echo json_encode($resultado);
                $file = file_get_contents(self::jsonUrl);
                $data = json_decode($file, true);
                foreach($data['lista'] as $key => $value)
                    {
                    if ($data['lista'][$key]["id"] == $this->id)
                        {
                        $data['lista'][$key]['marca'] = $this->marca;
                        $data['lista'][$key]['ano'] = $this->ano;
                        $data['lista'][$key]['modelo'] = $this->modelo;
                        }
                    }

                file_put_contents(self::jsonUrl, json_encode($data));
                }
              else
                {
                echo "PUT falta id";
                }

            break;

        case 'POST':
            $this->recordID = md5(date("Y-m-d H:i:s"));
            $this->marca = $_POST["marca"];
            $this->ano = $_POST["ano"];
            $this->modelo = $_POST['modelo'];
            $resultado = array(
                'id' => $this->recordID,
                'marca' => $this->marca,
                'ano' => $this->ano,
                'modelo' => $this->modelo
            );
            echo json_encode($resultado);
            $file = file_get_contents(self::jsonUrl);
            $data = json_decode($file, true);
            $data["lista"] = array_values($data["lista"]);
            array_push($data["lista"], $resultado);
            file_put_contents(self::jsonUrl, json_encode($data));
            break;

        case 'DELETE':
            if ($this->id)
                {
                $file = file_get_contents(self::jsonUrl);
                $data = json_decode($file, true);
                foreach($data['lista'] as $key => $value)
                    {
                    if ($data['lista'][$key]["id"] == $this->id)
                        {
                        unset($data['lista'][$key]);
                        }
                    }

                file_put_contents(self::jsonUrl, json_encode($data));
                }
              else
                {
                echo "falta id";
                }

            break;
            }
        }

    public

    function __destruct()
        {
        }
    }

$meuCarro = new carro();
echo $meuCarro->run();
?>