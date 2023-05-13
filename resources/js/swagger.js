import SwaggerUI from 'swagger-ui'
import 'swagger-ui/dist/swagger-ui.css';


const URL = window.OPENAPI_URL || 'http://127.0.0.1/api/openapi.yaml';

SwaggerUI({
  dom_id: '#swagger-api',
  url: URL,
});
