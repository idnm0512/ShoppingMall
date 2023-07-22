<?php
    namespace Common;

    class EntryPoint {

        private $uri;
        private $request_uri;
        private $request_method;

        public function __construct(Uri $uri, string $request_uri, string $request_method) {
            $this -> uri = $uri;
            $this -> request_uri = $request_uri;
            $this -> request_method = $request_method;
            $this -> checkUri();
        }

        private function checkUri() {
            if ($this -> request_uri !== strtolower($this -> request_uri)) {
                http_response_code(301);
                header('location: ' . strtolower($this -> request_uri));
            }
        }

        private function loadTemplate($template, $variables = []) {
            extract($variables);

            ob_start();

            include __DIR__ . '/../../templates/' . $template;

            return ob_get_clean();
        }

        public function run() {
            $uri = $this -> uri -> getUri();

            $controller = $uri[$this -> request_uri][$this -> request_method]['controller'];
            $action = $uri[$this -> request_uri][$this -> request_method]['action'];

            $result = $controller -> $action();

            if (isset($result['variables'])) {
                $output = $this -> loadTemplate($result['template'], $result['variables']);
            } else {
                $output = $this -> loadTemplate($result['template']);
            }

            $layoutTemplate = 'layout.html.php';

            $variables = [
                'output' => $output,
                'title' => $result['title']
            ];

            echo $this -> loadTemplate($layoutTemplate, $variables);
        }
    }