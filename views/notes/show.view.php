<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 underline">go back...</a>
        </p>

        <p><?= htmlspecialchars($note['body']) ?></p>

        <!-- form to delete a record -->
        <!-- method is set to POST because we can't handle DELETE, PATCH etc. -->
        <form class="mt-6" method="POST">
            <!-- this hidden input carries the actual request type we wat to submit -->
             <!-- now we just need to check if the form has a value of `DELETE` 
                  if so, favour that over the actual form method `POST` -->
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?=$note['id']?>">
                <button class="text-sm text-red-500">Delete</button>
        </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
