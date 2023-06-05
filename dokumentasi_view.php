<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.19.5/swagger-ui.css" >
    <style>
      .topbar {
        display: none;
      }
    </style>
  </head>

  <body>
    <div id="swagger-ui"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.19.5/swagger-ui-bundle.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.19.5/swagger-ui-standalone-preset.js"> </script>
    <script src="./openapi.js"> </script>
    <script>
      window.onload = function() {
        const ui = SwaggerUIBundle({
          spec: spec,
          dom_id: '#swagger-ui',
          deepLinking: true,
          presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
          ],
          plugins: [
            SwaggerUIBundle.plugins.DownloadUrl
          ],
          layout: "StandaloneLayout"
        })
     
        window.ui = ui
      }
  </script>
  </body>
</html>

<script>
var spec = {
  "openapi": "3.0.1",
  "info": {
    "version": "1.0.0",
    "title": "API Nomor Mahasiswa"
  },
  "paths": {
    "/new/api/rmsmhs_max": {
      "post": {
        "summary": "Create an Nim.",
        "operationId": "createNim",
        "tags": [
          "Nim API"
        ],
        
        
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/Nim"
              }
            }
          }
        },
        
        
        "responses": {
            
          "200": {
            "description": "Success",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Nim"
                }
              }
            }
          },
          
   
          
          "403": {
            "$ref": "#/components/responses/Gagal"
          },
          
          "400": {
            "$ref": "#/components/responses/Double"
          }

          
        }
      },
      
      
      "get": {
        "summary": "Get a list of Nims",
        "operationId": "listNims",
        "tags": [
          "Nim API"
        ],
        "parameters": [
          {
            "$ref": "#/components/parameters/Limit"
          },
          {
            "$ref": "#/components/parameters/Offset"
          }
        ],
        "responses": {
          "200": {
            "description": "Success",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/NimList"
                }
              }
            }
          }
        }
      }
    },
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    "/new/api/rmsmhs_max/{id}": {
      "get": {
        "summary": "Get an Nim.",
        "operationId": "getNim",
        "tags": [
          "Nim API"
        ],
        "parameters": [
          {
            "$ref": "#/components/parameters/Id"
          }
        ],
        "responses": {
          "200": {
            "description": "Success",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Nim"
                }
              }
            }
          },
          "404": {
            "$ref": "#/components/responses/NotFound"
          }
        }
      },
      "put": {
        "summary": "Update",
        "operationId": "updateNim",
        "tags": [
          "Nim API"
        ],
        "parameters": [
          {
            "$ref": "#/components/parameters/Id"
          }
        ],
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/Nim"
              }
            }
          }
        },
        "responses": {
          "200": {
            "description": "Success",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Nim"
                }
              }
            }
          },
          "400": {
            "$ref": "#/components/responses/NotFound"
          }
        }
      },
      "delete": {
        "summary": "Delete an Nim.",
        "operationId": "deleteNim",
        "tags": [
          "Nim API"
        ],
        "parameters": [
          {
            "$ref": "#/components/parameters/Id"
          }
        ],
        "responses": {
          "204": {
            "description": "Success"
          },
          "404": {
            "$ref": "#/components/responses/NotFound"
          }
        }
      }
    }
  },
  
  
  
  "components": {
      
      
    "schemas": {
        
        
      "id_masternim": {
        "description": "Resource ID",
        "type": "char",
        "format": "int64",
        "readOnly": true,
        "example": '0929b212-789b-4df1-be14-3e173aeed096'
      },
      
      
      "NimForList": {
        "properties": {
            
            
          "id": {
            "$ref": "#/components/schemas/Id"
          },
          
          
          
          
          "tahun_akademik": {
            "description": "Category of an Nim",
            "type": "string",
            "example": "2023"
          },

          "nmmhsmsmhs": {
            "description": "Nama Mahasiswa",
            "type": "string",
            "example": "EXAMPLE"
          },          
          
           "jalur": {
            "description": "1 - murni, 2 - pindahan, 3 - beasiswa",
            "type": "string",
            "example": "1"
          }, 
          
           "smawlmsmhs": {
            "description": "Semester Awal Masuk 2023=(2023/2024) semester 1 (ganjil)/ 2(genap) ",
            "type": "string",
            "example": "20231"
          }, 
          
          
           "nomor_registrasi": {
            "description": "Nomor Registrasi di PMB setelah melakukan pembayaran",
            "type": "string",
            "example": "23009090909090"
          }, 
          
          
          
          "tglhrmsmhs": {
            "description": "Tanggal Lahir Mahasiswa yyyy-mm-dd",
            "type": "string",
            "example": "2022-01-01"
          }, 
    
          "tplhrmsmhs": {
            "description": "Tempat Lahir Mahasiswa",
            "type": "string",
            "example": "YOGYAKARTA"
          },       
          
          "nmibumsmhs": {
            "description": "Nama Ibu di Akte Kelahiran",
            "type": "string",
            "example": "YOGYAKARTA"
          },  
          
          
          //  "id_masternim": "0929b212-789b-4df1-be14-3e173aeed096",
              //"nimhsmsmhs": "231325608",
              //"nmmhsmsmhs": "EXAMPLE",
              //"nomor_registrasi": "123534",
              //"tahun_akademik": "23",
              //"jalur": "1",
              //"prodi": "32",
              //"nomor_urut": "5608",
              //"kode_fakultas": "03",
              //"kdpstmsmhs": "69201",
              //"smawlmsmhs": "20231",
              //"tglhrmsmhs": "2022-01-01",
              //"tplhrmsmhs": "BANTUL",
              //"nmibumsmhs": "E",
              //"kdjenmsmhs": "C"
  
          
          
          
        }
      },
      
      
      "Nim": {
          
        "allOf": [
          {
            "$ref": "#/components/schemas/NimForList"
          }
        ],
        "required": [
          "text"
        ],
        "properties": {
          "kdpstmsmhs": {
            "description": "Content of an Nim",
            "type": "string",
            "maxLength": 1024,
            "example": "62201"
          }
        }
      },
      
      
      
      
      
      
      
      
      
      
      
      "NimList": {
        "type": "array",
        "items": {
          "$ref": "#/components/schemas/NimForList"
        }
      },
      
      
      
      "Error": {
        "description": "<table>\n  <tr>\n    <th>Code</th>\n    <th>Description</th>\n  </tr>\n  <tr>\n    <td>illegal_input</td>\n    <td>The input is invalid.</td>\n  </tr>\n  <tr>\n    <td>not_found</td>\n    <td>The resource is not found.</td>\n  </tr>\n</table>\n",
        "required": [
          "code",
          "message"
        ],
        "properties": {
          "code": {
            "type": "string",
            "example": "illegal_input"
          }
        }
      },
      
      
      
      
        //"status": false,
        //"error": "Invalid API key "      
        "Skemagagal": {
        "description": "<table>\n  <tr>\n    <th>Code</th>\n    <th>Description</th>\n  </tr>\n  <tr>\n    <td>illegal_input</td>\n    <td>The input is invalid.</td>\n  </tr>\n  <tr>\n    <td>not_found</td>\n    <td>The resource is not found.</td>\n  </tr>\n</table>\n",
        "required": [
          "code",
          "message"
        ],
        
        "properties": {
          "status": {
            "type": "string",
            "example": "false"
          },
          "error": {
            "type": "string",
            "example": "Invalid API key"
          }
        }
      },
      
      
             //"status": false,
        //"error": "Nomor registrasi sudah terdaftar"      
        "Doublereg": {
        "description": "<table>\n  <tr>\n    <th>Code</th>\n    <th>Description</th>\n  </tr>\n  <tr>\n    <td>illegal_input</td>\n    <td>The input is invalid.</td>\n  </tr>\n  <tr>\n    <td>not_found</td>\n    <td>The resource is not found.</td>\n  </tr>\n</table>\n",
        "required": [
          "code",
          "message"
        ],
        
        "properties": {
          "status": {
            "type": "string",
            "example": "false"
          },
          "error": {
            "type": "string",
            "example": "Nomor registrasi sudah terdaftar"
          }
        }
      }
      
      
      
      
    },
    
    
    
    
    
    
    
    
    
    
    
    "parameters": {
      "Id": {
        "name": "id",
        "in": "path",
        "description": "Resource ID",
        "required": true,
        "schema": {
          "$ref": "#/components/schemas/Id"
        }
      },
      "Limit": {
        "name": "limit",
        "in": "query",
        "description": "limit",
        "required": false,
        "schema": {
          "type": "integer",
          "minimum": 1,
          "maximum": 100,
          "default": 10,
          "example": 10
        }
      },
      "Offset": {
        "name": "offset",
        "in": "query",
        "description": "offset",
        "required": false,
        "schema": {
          "type": "integer",
          "minimum": 0,
          "default": 0,
          "example": 10
        }
      }
    },
    
///RESPON ERROR///

    "responses": {

      "Gagal": {
        "description": "XAPIKEY tidak didapatkan",
        "content": {
          "application/json": {
            "schema": {
              "$ref": "#/components/schemas/Skemagagal"
            }
          }
        }
      },      
      
      "Double": {
        "description": "XAPIKEY tidak didapatkan",
        "content": {
          "application/json": {
            "schema": {
              "$ref": "#/components/schemas/Doublereg"
            }
          }
        }
      },  
      
        
      "NotFound": {
        "description": "The resource is not found.",
        "content": {
          "application/json": {
            "schema": {
              "$ref": "#/components/schemas/Error"
            }
          }
        }
      },
      
      "IllegalInput": {
        "description": "The input is invalid.",
        "content": {
          "application/json": {
            "schema": {
              "$ref": "#/components/schemas/Error"
            }
          }
        }
      }
    }
  }
}    
    
</script>
