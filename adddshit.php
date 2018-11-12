<div class='post-entry-horzontal'>
                        <div class = 'image'>
                            <img src='$img' width='200px' heigh='167px' >
                        </div>
                        <span class = 'text'>
                            <div class='post-meta'>
                                <form action = 'likes.php' method = 'post'>
                                    $total_likes  <input type='submit' class = 'like' value = 'LIKE'/>
                                    <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/>
                                </form>
                                <span class='mr-2'>$time</span> &bullet;
                                <span class= 'ml-1'><span class= 'fa fa-comments'></span>$total</span>
                                <Button class = 'viewComments' onclick='hidetest(".$y.")'>View Comments</button>
                                <div id = 'hidden".$y."' style = 'display:none' >
                                    <p>".showcomments($imgid)."</p><hr></br>
                                </div>
                                <form action = 'comments.php' method='post'>
                                    <input type='text' name='comment' id = 'comment' autocomplete='off' placeholder='Comment on Picture' align = 'left'/>
                                    <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/>
                                    <input type='submit' value = 'send'/>
                                </form>
                            </div>
                        </span>
                    </div>