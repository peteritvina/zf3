<?php
namespace Blog\Model;
interface PostRepositoryInterface{
    /*
     * Return a set of all blog posts that we can iterate over
     * Each entry should be a Post instance
     * return Post[];
     * 
     */
    public function findAllPosts();
    /*
     * return a single blog post
     * $id: identifies of the post to return
     */
    public function findPost($id);
    
    
}