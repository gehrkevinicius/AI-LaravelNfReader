<?php $__env->startSection('title', 'Nota #' . $nota->id); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('sucesso')): ?>
        <div class="mb-8 border-l-4 border-sky-600 bg-sky-50 px-4 py-3 text-sm text-zinc-800">
            <?php echo e(session('sucesso')); ?>

        </div>
    <?php endif; ?>

    <div class="mb-8 flex flex-col gap-6 border-b border-zinc-200 pb-8 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm text-zinc-500">Registro <span class="font-mono font-medium text-zinc-700">#<?php echo e($nota->id); ?></span></p>
            <h1 class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900 sm:text-4xl">
                <?php echo e($nota->empresa ?? 'Nota fiscal'); ?>

            </h1>
            <p class="mt-2 text-sm text-zinc-600">
                Emissão
                <?php if($nota->data_emissao): ?>
                    <time datetime="<?php echo e($nota->data_emissao); ?>"><?php echo e(\Illuminate\Support\Carbon::parse($nota->data_emissao)->format('d/m/Y')); ?></time>
                <?php else: ?>
                    —
                <?php endif; ?>
            </p>
        </div>
        <a
            href="<?php echo e(url('/')); ?>"
            class="inline-flex w-fit items-center rounded-md border border-zinc-300 bg-white px-4 py-2.5 text-sm font-medium text-zinc-800 shadow-sm transition hover:border-zinc-400 hover:bg-zinc-50"
        >
            Outra nota
        </a>
    </div>

    <div class="mb-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium text-zinc-500">Valor total</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums tracking-tight text-zinc-900">
                <?php if($nota->valor_total !== null && $nota->valor_total !== ''): ?>
                    R$ <?php echo e(number_format((float) $nota->valor_total, 2, ',', '.')); ?>

                <?php else: ?>
                    —
                <?php endif; ?>
            </p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium text-zinc-500">Desconto</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums tracking-tight text-zinc-900">
                <?php if($nota->valor_desconto !== null && $nota->valor_desconto !== ''): ?>
                    R$ <?php echo e(number_format((float) $nota->valor_desconto, 2, ',', '.')); ?>

                <?php else: ?>
                    —
                <?php endif; ?>
            </p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm sm:col-span-1">
            <p class="text-xs font-medium text-zinc-500">Categoria</p>
            <p class="mt-2 text-base text-zinc-900"><?php echo e($nota->categoria ?? '—'); ?></p>
        </div>
    </div>

    <section class="mb-8 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
        <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Dados da nota</h2>
        <dl class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <dt class="text-xs font-medium text-zinc-500">CNPJ emitente</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->cnpj ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Inscrição estadual</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->inscricao_estadual ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Inscrição municipal</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->inscricao_municipal ?? '—'); ?></dd>
            </div>
            <div class="sm:col-span-2 lg:col-span-3">
                <dt class="text-xs font-medium text-zinc-500">Chave de acesso</dt>
                <dd class="mt-0.5 break-all font-mono text-sm text-zinc-900"><?php echo e($nota->chave_acesso ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Série</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->serie ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Destinatário</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->cnpj_destinatario ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Volume</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->volume ?? '—'); ?></dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-zinc-500">Peso</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->peso ?? '—'); ?></dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-xs font-medium text-zinc-500">Transportadora</dt>
                <dd class="mt-0.5 text-sm text-zinc-900"><?php echo e($nota->transportadora ?? '—'); ?></dd>
            </div>
        </dl>
    </section>

    <?php if($nota->observacoes): ?>
        <section class="mb-8 rounded-lg border border-dashed border-zinc-300 bg-zinc-50/80 p-6 sm:p-8">
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Observações</h2>
            <p class="mt-4 whitespace-pre-wrap text-sm leading-relaxed text-zinc-800"><?php echo e($nota->observacoes); ?></p>
        </section>
    <?php endif; ?>

    <section class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-100 bg-zinc-50/90 px-6 py-4 sm:px-8">
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Itens</h2>
            <p class="mt-1 text-sm text-zinc-500"><?php echo e($nota->itens->count()); ?> <?php echo e($nota->itens->count() === 1 ? 'linha' : 'linhas'); ?></p>
        </div>
        <?php if($nota->itens->isEmpty()): ?>
            <p class="px-6 py-10 text-center text-sm text-zinc-500 sm:px-8">Nenhum item registrado.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 bg-zinc-100/80 text-sm text-zinc-700">
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">SKU</th>
                            <th class="px-4 py-3 font-semibold sm:px-6">Descrição</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold tabular-nums sm:px-6">Qtd</th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">UN</th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">NCM</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold tabular-nums sm:px-6">Unit.</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold tabular-nums sm:px-6">ICMS</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold tabular-nums sm:px-6">Desc.</th>
                            <th class="whitespace-nowrap px-4 py-3 pr-6 text-right font-semibold tabular-nums sm:px-8">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        <?php $__currentLoopData = $nota->itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="bg-white hover:bg-zinc-50/80">
                                <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-zinc-700 sm:px-6"><?php echo e($item->codigo_sku ?? '—'); ?></td>
                                <td class="max-w-[220px] px-4 py-3 text-zinc-800 sm:max-w-xs"><?php echo e($item->descricao ?? '—'); ?></td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-800 sm:px-6"><?php echo e($item->quantidade !== null ? $item->quantidade : '—'); ?></td>
                                <td class="whitespace-nowrap px-4 py-3 text-zinc-700 sm:px-6"><?php echo e($item->unidade_medida ?? '—'); ?></td>
                                <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-zinc-700 sm:px-6"><?php echo e($item->ncm ?? '—'); ?></td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-800 sm:px-6">
                                    <?php if($item->valor_unitario !== null && $item->valor_unitario !== ''): ?>
                                        <?php echo e(number_format((float) $item->valor_unitario, 2, ',', '.')); ?>

                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-800 sm:px-6">
                                    <?php if($item->valor_icms !== null && $item->valor_icms !== ''): ?>
                                        <?php echo e(number_format((float) $item->valor_icms, 2, ',', '.')); ?>

                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-800 sm:px-6">
                                    <?php if($item->valor_desconto !== null && $item->valor_desconto !== ''): ?>
                                        <?php echo e(number_format((float) $item->valor_desconto, 2, ',', '.')); ?>

                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 pr-6 text-right tabular-nums font-medium text-zinc-900 sm:px-8">
                                    <?php if($item->valor_total !== null && $item->valor_total !== ''): ?>
                                        <?php echo e(number_format((float) $item->valor_total, 2, ',', '.')); ?>

                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Gehrke\Desktop\nota-fiscal\resources\views/nota-show.blade.php ENDPATH**/ ?>