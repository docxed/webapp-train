<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-light p-2">
        <h2>Simple Blog</h2>
    </div>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3">
                <!-- Profile -->
                <div class="row">
                    <div class="col-4"><img class="rounded" width="100%" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="person avatar"></p>
                    </div>
                    <div class="col-8 my-auto">
                        <p class="h4">Your Name</p>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-sm-12 col-md-6  col-lg-6">
                <!-- Post Form -->
                <form action="index.php" class="mb-3" method="post">
                    <div class="card">
                        <div class="card-header"><b>Post Here</b></div>
                        <div class="card-body">
                            <textarea name="content" class="form-control" rows="2" placeholder="Tell your feeling"></textarea>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" name="submit" class="btn btn-primary">Post</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Post -->
                <div class="card mb-3">
                    <div class="card-header"><b>Post</b></div>
                    <div class="card-body">
                        post1
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><b>Post</b></div>
                    <div class="card-body">
                        post2
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><b>Post</b></div>
                    <div class="card-body">
                        post3
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><b>Post</b></div>
                    <div class="card-body">
                        post4
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <!-- Ads -->
                <?php
                for ($i = 0; $i < 3; $i++) {
                ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Going to be ad</h4>
                            <h6 class="card-subtitle text-muted">Free ad Contact me.</h6>
                            <hr>
                            <p>Ad ad ad here</p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>