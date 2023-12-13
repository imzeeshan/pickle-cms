@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                    
                    <div class="card-header">
                        <h4 class="card-title">Create a new Page</h4>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                  <a href="#default-tab" class="nav-link active" data-bs-toggle="tab">Default </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#grapejs-tab" class="nav-link" data-bs-toggle="tab">GrapeJS</a>
                                </li>
                              </ul>
                        </div>

                        <div class="card-body">
                          <div class="tab-content">

                            <div class="tab-pane active show" id="default-tab">
                                <form class="form-group" role="form" method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="mb-3">
                                        <div class="form-group col-6">
                                            <label class="form-label" for="title">{{ __('Title') }}</label>
                                            <input id="title" type="text" class="form-control" value="" name="title" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group col-8">
                                            <label class="form-label" for="description">{{ __('Description') }}</label>
                                            <textarea class="form-control summernote" id='summernote' name="description" rows="20"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Publish') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="grapejs-tab">
                                <form class="form-group" role="form" method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="mb-3">
                                        <div class="form-group col-6">
                                            <label class="form-label" for="title">{{ __('Title') }}</label>
                                            <input id="title" type="text" class="form-control" value="" name="title" required>
                                        </div>
                                    </div>

                                    <div class="panel__top">
                                        <div class="panel__basic-actions"></div>
                                    </div>
                                    <div class="editor-row">
                                          <div class="editor-canvas" style="height: 800px;">
                                              <div id="gjs"></div>
                                          </div>
                                          <div class="panel__right">
                                              <div class="layers-container"></div>
                                          </div>
                                    </div>
                                    <div id="blocks">
                                    </div>

                                    <div class="form-group col-6">
                                        <button onclick="save_grapejs_data()" class="btn btn-primary">{{ __('Publish') }}</button>
                                    </div>

                                    <input type="hidden" id="page_html" name="page_html" value=""/>
                                    <input type="hidden" id="page_css"  name="page_css" value=""/>

                                </form>

                         
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://unpkg.com/grapesjs@0.21.3/dist/grapes.min.js"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.3/dist/index.js"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5"></script>
    <script src="https://unpkg.com/grapesjs-component-countdown@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-export@1.0.11"></script>
    <script src="https://unpkg.com/grapesjs-tabs@1.0.6"></script>
    <script src="https://unpkg.com/grapesjs-custom-code@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-touch@0.1.1"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-tooltip@0.1.7"></script>
    <script src="https://unpkg.com/grapesjs-tui-image-editor@0.1.3"></script>
    <script src="https://unpkg.com/grapesjs-typed@1.0.5"></script>
    <script src="https://unpkg.com/grapesjs-style-bg@2.0.1"></script>

    <script>

        $(document).ready(function() {         
            $('#summernote').summernote();
        });
 
        var pageHTML = "";
        var pageCSS  = "";
        var editor = grapesjs.init({
            height: '100%',
            showOffsets: 1,
            noticeOnUnload: 0,
            storageManager: { autoload: 0 },
            container: '#gjs',
            fromElement: true,

            plugins: [
            'gjs-blocks-basic',
            'grapesjs-plugin-forms',
            'grapesjs-component-countdown',
            'grapesjs-plugin-export',
            'grapesjs-tabs',
            'grapesjs-custom-code',
            'grapesjs-touch',
            'grapesjs-parser-postcss',
            'grapesjs-tooltip',
            'grapesjs-tui-image-editor',
            'grapesjs-typed',
            'grapesjs-style-bg',
            'grapesjs-preset-webpage',
            ],
            pluginsOpts: {
          'gjs-blocks-basic': { flexGrid: true },
          'grapesjs-tui-image-editor': {
            script: [
              'https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js',
              'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.js',
              'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.js'
            ],
            style: [
              'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.css',
              'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.css',
            ],
          },
          'grapesjs-tabs': {
            tabsBlock: { category: 'Extra' }
          },
          'grapesjs-typed': {
            block: {
              category: 'Extra',
              content: {
                type: 'typed',
                'type-speed': 40,
                strings: [
                  'Text row one',
                  'Text row two',
                  'Text row three',
                ],
              }
            }
          },
          'grapesjs-preset-webpage': {
            modalImportTitle: 'Import Template',
            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
            modalImportContent: function(editor) {
              return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
            },
          },
        },
      });

      editor.I18n.addMessages({
        en: {
          styleManager: {
            properties: {
              'background-repeat': 'Repeat',
              'background-position': 'Position',
              'background-attachment': 'Attachment',
              'background-size': 'Size',
            }
          },
        }
      });

    function save_grapejs_data(){
            pageHTML = editor.getHtml();
            pageCSS  = editor.getCss();
            $("#page_html").val(pageHTML);
            $("#page_css").val(pageCSS);
        }
    </script>

@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://unpkg.com/grapesjs@0.21.3/dist/css/grapes.min.css" rel="stylesheet">
@endsection 



