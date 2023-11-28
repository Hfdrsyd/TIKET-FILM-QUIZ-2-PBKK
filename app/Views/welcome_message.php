<?php

use Kint\Zval\Value;

$imageUrl = base_url('images/hujan_cover.jpeg');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <?php echo view('layouts/navbar') ?>
    <main class="min-h-screen py-32 flex items-start gap-12 w-10/12 mx-auto">
        <section class="grow">
            <section class="">
                <div class="flex items-center gap-8">
                    <p class="text-lg font-medium pb-2.5 border-b border-slate-500">Film (<span><?= count($films) ?></span>)</p>
                    <p class="text-lg font-medium pb-2.5 text-slate-300">Bioskop</p>
                </div>
                <div class="h-px w-full bg-slate-200"></div>
            </section>
            <section class="mt-6 flex flex-wrap justify-between gap-4">
                <?php foreach ($films as $film) : ?>
                    <div class="max-w-[11rem] space-y-2 shadow p-2.5 group hover:bg-sky-500 rounded-md">
                        <a href="/film/<?= $film['id'] ?>" class="inline-block">
                            <img src="<?= $film['cover'] ?>" alt="" class="w-full">
                        </a>
                        <div class="flex items-end justify-between">
                            <div class="w-1/2">
                                <p class="group-hover:text-white text-slate-500 text-xs truncate"><?= $film['author'] ?></p>
                                <p class="group-hover:text-white font-medium text-sm truncate"><?= $film['title'] ?></p>
                            </div>
                            <p class="group-hover:text-white font-semibold text-xs text-slate-500 shrink-0">Rp <?= $film['price'] ?></p>
                        </div>
                        <div>
                            <p class="group-hover:text-white line-clamp-2 text-sm"><?= $film['genre'] ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </section>
            <?php if ($role === 'admin') { ?>
                <a href="/upload" type="button" class="btn btn-outline-primary" style="margin-top: 20px; margin-bottom:20px;">upload</a>
            <?php } ?>
            <!-- slicing comment -->
            <div class="flex justify-between">
                <?php foreach ($comments as $comment) : ?>
                <div class="max-w-md mx-auto border px-6 py-4 rounded-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/97.jpg" alt="Avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="text-md font-medium text-gray-800"><?= $comment['username'] ?></div>
                            <!-- <div class="text-gray-500"><?= $comment['created_at'] ?></div> -->
                        </div>
                    </div>
                    <p class="text-md leading-relaxed mb-6"><?= $comment['comment'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- upload comment  -->
            <form action="<?= route_to('comment.create') ?>" method="POST">
                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 my-4">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <input type="submit" value="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post comment
                        </input>
                        <input type="hidden" id="user_id" name="user_id" value=<?= $user_id ?>>
                    </div>
                </div>
            </form>

        </section>
        
    

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>