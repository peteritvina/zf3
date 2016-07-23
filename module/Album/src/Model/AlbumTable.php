<?php 
namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class AlbumTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    private function fetchPaginatedResult(){
        //create a new object for select table
        $select = new Select($this->tableGateway->getTable());
        //Create a new result set base on Album entity
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Album());
        //Create a new pagination Object adapter object
        $paginatorAdapter = new DbSelect(
            //our configed select object
            $select,
            //Adapter to run it again
            $this->tableGateway->getAdapter(),
            //the result set to hydrate,
            $resultSetPrototype
            );
        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }
    public function fetchAll($paginated = FALSE)
    {
        if($paginated){
            return $this->fetchPaginatedResult();
        }
        return $this->tableGateway->select();
        
        //return $this->tableGateway->select();
    }

    public function getAlbum($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = [
            'artist' => $album->artist,
            'title'  => $album->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getAlbum($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}