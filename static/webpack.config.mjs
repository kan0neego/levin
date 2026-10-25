// webpack.config.mjs — сборка CSS в минифицированные бандлы static/css/.
//
// Две точки входа:
//   css/index.css  → static/css/bundle.css        (фронт, подключается через style.css)
//   css/editor.css → static/css/bundle-editor.css (блочный редактор Gutenberg,
//                                                  подключается через add_editor_style())

import { fileURLToPath } from 'node:url';
import { dirname, resolve } from 'node:path';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin';

const __dirname = dirname(fileURLToPath(import.meta.url));

// У webpack'а у каждой entry всегда есть JS-энтрипоинт, даже если модуль —
// чистый CSS. После извлечения CSS остаётся пустой JS-бутстрап (~118 б),
// который теме не нужен (подключается только [name].css). Удаляем такие
// пустые JS-ассеты до emit — на выходе остаются только bundle.css и
// bundle-editor.css.
class RemoveEmptyJsPlugin {
    apply( compiler ) {
        compiler.hooks.thisCompilation.tap( 'RemoveEmptyJsPlugin', ( compilation ) => {
            compilation.hooks.processAssets.tap(
                {
                    name: 'RemoveEmptyJsPlugin',
                    stage: compiler.webpack.Compilation.PROCESS_ASSETS_STAGE_SUMMARIZE,
                },
                ( assets ) => {
                    for ( const name of Object.keys( assets ) ) {
                        if ( name.endsWith( '.css.js' ) ) {
                            compilation.deleteAsset( name );
                        }
                    }
                }
            );
        } );
    }
}

export default {
    mode: 'production',
    entry: {
        bundle: resolve(__dirname, 'css', 'index.css'),
        'bundle-editor': resolve(__dirname, 'css', 'editor.css'),
    },
    output: {
        path: resolve(__dirname, 'css'),
        filename: '[name].css.js',
        clean: false,
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                        },
                    },
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
        new RemoveEmptyJsPlugin(),
    ],
    optimization: {
        minimizer: [new CssMinimizerPlugin()],
        minimize: true,
    },

    performance: { hints: false },
};
