<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = "SELECT * FROM posts";
                        $allPosts = mysqli_query($connection, $query);
                    
                        while ($row = mysqli_fetch_assoc($allPosts)) {
                            $postId = $row['post_id'];
                            $postAuthor = $row['post_author'];
                            $postTitle = $row['post_title'];
                            $postCatId = $row['post_category_id'];
                            $postStatus = $row['post_status'];
                            $postImage = $row['post_image'];
                            $postTags = $row['post_tags'];
                            $postCommentCNT = $row['post_comment_count'];
                            $postDate = $row['post_date'];

                            print("<tr>");
                            print("<td>{$postId}</td>");
                            print("<td>{$postAuthor}</td>");
                            print("<td>{$postTitle}</td>");
                            print("<td>{$postCatId}</td>");
                            print("<td>{$postStatus}</td>");
                            print("<td><img class='img-responsive' width='100' src='../images/{$postImage}' alt='image'></td>");
                            print("<td>{$postTags}</td>");
                            print("<td>{$postCommentCNT}</td>");
                            print("<td>{$postDate}</td>");
                            print("</tr>");
                        }

                        ?>


                        <td>50</td>
                        <td>Arman Valaee</td>
                        <td>Bootstrap Framework</td>
                        <td>Bootstrap</td>
                        <td>Status</td>
                        <td>Image</td>
                        <td>Tags</td>
                        <td>Comments</td>
                        <td>Date</td>
                    </tbody>
                </table>