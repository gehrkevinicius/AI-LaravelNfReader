@extends('layouts.app')

@section('title', 'Notas salvas')

@section('content')
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-zinc-900">Notas salvas</h1>
            <p class="mt-2 text-sm text-zinc-600">Consulta posterior dos registros já processados.</p>
        </div>
        <a
            href="{{ url('/') }}"
            class="inline-flex w-fit items-center rounded-md bg-sky-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2"
        >
            Incluir nova
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-100 bg-zinc-50/90 px-6 py-4 sm:px-8">
            <p class="text-sm font-medium text-zinc-800">
                {{ $notas->total() }} {{ $notas->total() === 1 ? 'nota' : 'notas' }}
            </p>
        </div>

        @if ($notas->isEmpty())
            <div class="px-6 py-10 text-center text-sm text-zinc-500 sm:px-8">
                Nenhuma nota salva ainda. <a class="text-sky-700 underline underline-offset-4 hover:text-sky-600" href="{{ url('/') }}">Enviar a primeira</a>.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 bg-zinc-100/80 text-sm text-zinc-700">
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">#</th>
                            <th class="px-4 py-3 font-semibold sm:px-6">Empresa</th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">CNPJ</th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold sm:px-6">Emissão</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold tabular-nums sm:px-6">Total</th>
                            <th class="whitespace-nowrap px-4 py-3 pr-6 text-right font-semibold sm:px-8">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($notas as $nota)
                            <tr class="bg-white hover:bg-zinc-50/80">
                                <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-zinc-700 sm:px-6">{{ $nota->id }}</td>
                                <td class="max-w-[320px] px-4 py-3 text-zinc-800 sm:px-6">
                                    {{ $nota->empresa ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-zinc-700 sm:px-6">{{ $nota->cnpj ?? '—' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-zinc-700 sm:px-6">
                                    @if ($nota->data_emissao)
                                        {{ \Illuminate\Support\Carbon::parse($nota->data_emissao)->format('d/m/Y') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-800 sm:px-6">
                                    @if ($nota->valor_total !== null && $nota->valor_total !== '')
                                        R$ {{ number_format((float) $nota->valor_total, 2, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 pr-6 text-right sm:px-8">
                                    <a
                                        href="{{ route('notas.show', $nota) }}"
                                        class="inline-flex items-center rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-sm font-medium text-zinc-800 shadow-sm transition hover:border-zinc-400 hover:bg-zinc-50"
                                    >
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-zinc-100 bg-white px-6 py-4 sm:px-8">
                {{ $notas->links() }}
            </div>
        @endif
    </div>
@endsection

