@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="lead">Restaurant Finder</p>
                <div class="list-group">
                    <li class="list-group-item active">Info 1</li>
                    <li class="list-group-item">Info 2</li>
                    <li class="list-group-item">Info 3</li>
                </div>
            </div>
            <div class="col-md-9">
                <div class="img-thumbnail">
                    <img class="img-fluid" src="../public/img/cover.jpg">
                    <div class="caption-full">
                        <h4><a href=""><?php echo $data['name']; ?></a></h4>
                        <p><?php echo $data['address']; ?></p>
                        <p>
                            <em>012852456</em>
                                
                        </p>
                    </div>
                </div>
                <div class="card card-body bg-light">
                    <div class="text-right">
                        <a class="btn btn-success" href="./addComment.php?id=<?php echo urlencode($_GET['id']); ?>">Add New Comment</a>
                    </div>
                    <hr>
                    <?php
                    foreach($comment_row as $row){ 
                        $uname = $user->findUserById($row['user_id']);
                        // echo $user->findUserById($row['user_id']);
                        echo '<div class="row">';
                        echo '<div class="col-md-12">';
                        echo '<strong>'.$uname["name"].'</strong>';
                        echo '<span class="float-right">'.$row["created_at"].'</span>';
                        echo '<p>'.$row["body"].'</p>';
    
                        if($_SESSION['user_id'] == $row['user_id']){
                            echo '<a class="btn btn-sm btn-warning" href="./editComment.php?id='.urlencode($_GET['id']).'&cid='.urlencode($row['id']).'">Edit</a>';
                            echo '<form class="delete-form" action="./deleteComment.php?id='.urlencode($_GET['id']).'&cid='.urlencode($row['id']).'" method="POST">';
                            echo '<input type="submit" name="" class="btn btn-sm btn-danger ml-1" value="Delete">';
                            echo '</form>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

@endsection