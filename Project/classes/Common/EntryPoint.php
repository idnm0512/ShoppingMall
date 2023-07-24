<?php
    namespace Common;

    use Common\Uri;

    class EntryPoint {
        
        private $uri;
        private $reqUri;
        private $reqMethod;

        public function __construct(Uri $uri, string $reqUri, string $reqMethod) {
            $this -> uri = $uri;
            $this -> reqUri = $reqUri;
            $this -> reqMethod = $reqMethod;

            $this -> checkUri();
        }

        private function checkUri() {
            if ($this -> reqUri !== strtolower($this -> reqUri)) {
                http_response_code(301);

                header('location: ' . strtolower($this -> reqUri));
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

            $controller = $uri[$this -> reqUri][$this -> reqMethod]['controller'];
            $action = $uri[$this -> reqUri][$this -> reqMethod]['action'];

            $pageInfo = $controller -> $action();

            if (isset($pageInfo['variables'])) {
                $output = $this -> loadTemplate($pageInfo['template'], $pageInfo['variables']);
            } else {
                $output = $this -> loadTemplate($pageInfo['template']);
            }

            echo $this -> loadTemplate('layout.html.php', [
                'output' => $output,
                'title' => $pageInfo['title']
            ]);
        }
    }