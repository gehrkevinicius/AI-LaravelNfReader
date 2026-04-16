

<?php $__env->startSection('title', 'Enviar arquivo'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mx-auto max-w-xl">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold tracking-tight text-zinc-900">Incluir nota</h1>
            <p class="mt-2 text-sm leading-relaxed text-zinc-600">PDF ou imagem. Limite de 10&nbsp;MB por arquivo.</p>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
            <?php if(session('sucesso')): ?>
                <div class="mb-6 border-l-4 border-sky-600 bg-sky-50 px-4 py-3 text-sm text-zinc-800">
                    <?php echo e(session('sucesso')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900" role="alert">
                    <p class="mb-2 font-medium">Algo deu errado:</p>
                    <ul class="list-inside list-disc space-y-1 text-red-800">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($erro); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(url('/processar')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="arquivo" class="mb-2 block text-sm font-medium text-zinc-700">Arquivo</label>
                    <input
                        id="arquivo"
                        type="file"
                        name="arquivo"
                        accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
                        required
                        class="block w-full cursor-pointer rounded-md border border-zinc-300 bg-zinc-50 px-3 py-3 text-sm text-zinc-800 file:mr-4 file:rounded file:border-0 file:bg-zinc-700 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-white hover:file:bg-zinc-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                    >
                    <p class="mt-2 text-xs text-zinc-500">Formatos aceitos: PDF, JPEG, PNG</p>
                </div>
                <button
                    type="submit"
                    class="w-full rounded-md bg-sky-700 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2"
                >
                    Processar
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Gehrke\Desktop\nota-fiscal\resources\views/upload.blade.php ENDPATH**/ ?>