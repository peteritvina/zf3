<?php 
namespace Blog\Model;

class PostRepository implements PostRepositoryInterface
{
    private $data = [
        1 => [
            'id'    => 1,
            'title' => 'Hello World #1',
            'text'  => 'This is our first blog post!',
        ],
        2 => [
            'id'    => 2,
            'title' => 'Hello World #2',
            'text'  => 'This is our second blog post!',
        ],
        3 => [
            'id'    => 3,
            'title' => 'Hello World #3',
            'text'  => 'This is our third blog post!',
        ],
        4 => [
            'id'    => 4,
            'title' => 'Hello World #4',
            'text'  => 'This is our fourth blog post!',
        ],
        5 => [
            'id'    => 5,
            'title' => 'Hello World #5',
            'text'  => 'This is our fifth blog post!',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        //print_r($this->data);
        // TODO: Implement findAllPosts() method.
        return array_map(function($post){
            return new Post(
                    $post["title"],
                    $post["text"],
                    $post["id"]
                );
        }, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('posts');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving blog post with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
        $resultSet->initialize($result);
        $post = $resultSet->current();

        if (! $post) {
            throw new InvalidArgumentException(sprintf(
                'Blog post with identifier "%s" not found.',
                $id
            ));
        }

        return $post;
    }
}