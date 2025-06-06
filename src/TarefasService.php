<?php
namespace LuizPereira\Usuario\Service;
class TarefaService{
  private $filePath = __DIR__ . '../data_tarefa.json';
    private function readData()
    {
        if (!file_exists($this->filePath)){
            file_put_contents($this->filePath, json_encode([]));
        }
        $json = file_get_contents($this->filePath);
        return json_decode($json, true);
    }
    private function writeData($data)
{
    file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
}
 
public function createTarefas($tarefa)
{
    $data = $this->readData();
    $tarefa ['id'] = uniqid();
    $data[] =  $tarefa;
    $this->writeData($data);
}
public function gettAllTarefas()
{
    return $this->readData();
}
 
public function getTarefaById($id)
{
    $data = $this->readData();
    foreach($data as $tarefa){
        if ($tarefa['id'] == $id){
            return $tarefa;
        }
    }
    return null;
}
public function updateTarefa($id, $updatedTarefa)
{
    $data = $this->readData();
    foreach($data as &$tarefa){
        if ($tarefa['id'] == $id){
            $tarefas = array_merge($tarefa,$updatedTarefa);
            $this->writeData($data);
            return true;
        }
    }
    return false;
}
public function deleteTarefa($id)
{
    $data = $this->readData();
    $filteredData = array_filter($data, fn($tarefa)=> $tarefa['id'] != $id);
    $this->writeData(array_values($filteredData));
    return count($data) != count($filteredData);
}
}
?>