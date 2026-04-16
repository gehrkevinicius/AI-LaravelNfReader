<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class NotaFiscalController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function listar()
    {
        $notas = NotaFiscal::query()
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('notas-index', ['notas' => $notas]);
    }

    public function show(NotaFiscal $nota)
    {
        $nota->load('itens');

        return view('nota-show', ['nota' => $nota]);
    }

    public function processar(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $arquivo = $request->file('arquivo');
        $base64 = base64_encode((string) file_get_contents($arquivo->getPathname()));
        $mimeType = $arquivo->getMimeType();

        try {
            $response = Http::withHeaders([
                'x-api-key' => (string) config('services.anthropic.key', env('ANTHROPIC_API_KEY')),
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model' => config('services.anthropic.model'),
                'max_tokens' => 2000,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => $mimeType === 'application/pdf' ? 'document' : 'image',
                                'source' => [
                                    'type' => 'base64',
                                    'media_type' => $mimeType,
                                    'data' => $base64,
                                ],
                            ],
                            [
                                'type' => 'text',
                                'text' => 'Analise esta nota fiscal e retorne APENAS um JSON válido, sem texto antes ou depois, com os campos: empresa, cnpj, inscricao_estadual, inscricao_municipal, chave_acesso, data_emissao (formato YYYY-MM-DD), valor_total, valor_desconto, categoria (alimentação/transporte/material de escritório/etc), serie, observacoes, cnpj_destinatario, volume, peso, transportadora. E um array "itens" onde cada item tem: codigo_sku, descricao, quantidade, unidade_medida, ncm, valor_unitario, valor_icms, valor_desconto, valor_total. Campos não encontrados retorne null.',
                            ],
                        ],
                    ],
                ],
            ]);
        } catch (Throwable $e) {
            return back()->withErrors(['arquivo' => 'Falha ao contatar a API: '.$e->getMessage()]);
        }

        if (! $response->successful()) {
            $detail = $response->json('error.message') ?? $response->body();

            return back()->withErrors(['arquivo' => 'API retornou erro ('.$response->status().'): '.(is_string($detail) ? $detail : json_encode($detail))]);
        }

        $texto = '';
        foreach ($response->json('content', []) as $block) {
            if (($block['type'] ?? '') === 'text' && isset($block['text'])) {
                $texto .= $block['text'];
            }
        }
        $texto = trim(str_replace(['```json', '```'], '', $texto));
        $dados = json_decode($texto, true);

        if (! is_array($dados)) {
            return back()->withErrors(['arquivo' => 'Não foi possível interpretar o JSON retornado pela IA.']);
        }

        try {
            $nota = NotaFiscal::create([
                'empresa' => $dados['empresa'] ?? null,
                'cnpj' => $dados['cnpj'] ?? null,
                'inscricao_estadual' => $dados['inscricao_estadual'] ?? null,
                'inscricao_municipal' => $dados['inscricao_municipal'] ?? null,
                'chave_acesso' => $dados['chave_acesso'] ?? null,
                'data_emissao' => $dados['data_emissao'] ?? null,
                'valor_total' => $dados['valor_total'] ?? null,
                'valor_desconto' => $dados['valor_desconto'] ?? null,
                'categoria' => $dados['categoria'] ?? null,
                'serie' => $dados['serie'] ?? null,
                'observacoes' => $dados['observacoes'] ?? null,
                'cnpj_destinatario' => $dados['cnpj_destinatario'] ?? null,
                'volume' => $dados['volume'] ?? null,
                'peso' => $dados['peso'] ?? null,
                'transportadora' => $dados['transportadora'] ?? null,
            ]);

            foreach ($dados['itens'] ?? [] as $item) {
                if (is_array($item)) {
                    $nota->itens()->create($item);
                }
            }
        } catch (Throwable $e) {
            return back()->withErrors(['arquivo' => 'Erro ao salvar no banco: '.$e->getMessage()]);
        }

        return redirect()
            ->route('notas.show', $nota)
            ->with('sucesso', 'Nota fiscal processada com sucesso!');
    }
}
