## API Endpoints

### GET /album

Obtiene una lista de todos los álbumes.

**Parámetros de consulta:**

- `sortOrder`: Orden de los resultados ('ASC' o 'DESC').
- `sortField`: Campo por el cual ordenar los resultados.
- `filterField`: Campo por el cual filtrar los resultados.
- `filterValue`: Valor para el filtro.
- `resultLimit`: Cantidad máxima de resultados a retornar.
- `resultOffset`: Cantidad de resultados a omitir.

**Ejemplo de uso:**

```
http://localhost/TPE_3/album?sortOrder=ASC&sortField=Nombre_Album&filterField=Album_ID&filterValue=1&resultLimit=10&resultOffset=0
```

### POST /album

Inserta un nuevo álbum.

**Cuerpo de la solicitud:**

- `Nombre_Album`: Nombre del álbum.
- `Año`: Año del álbum.
- `Banda_ID`: ID de la banda del álbum.

**Ejemplo de uso:**

```json
{
    "Nombre_Album": "Nombre del nuevo álbum",
    "Año": "Año del nuevo álbum",
    "Banda_ID": "ID de la banda del nuevo álbum"
}
```

### GET /album/:ID

Obtiene un álbum específico.

**Parámetros de ruta:**

- `ID`: ID del álbum.

**Ejemplo de uso:**

```
http://localhost/TPE_3/album/{ID}
```

### DELETE /album/:ID

Elimina un álbum específico.

**Parámetros de ruta:**

- `ID`: ID del álbum.

**Ejemplo de uso:**

```
http://localhost/TPE_3/album/{ID}
```

### PUT /album/:ID

Actualiza un álbum específico.

**Parámetros de ruta:**

- `ID`: ID del álbum.

**Cuerpo de la solicitud:**

- `Nombre_Album`: Nuevo nombre del álbum.
- `Año`: Nuevo año del álbum.
- `Banda_ID`: Nuevo ID de la banda del álbum.

**Ejemplo de uso:**

```json
{
    "Nombre_Album": "Nuevo nombre del álbum",
    "Año": "Nuevo año del álbum",
    "Banda_ID": "Nuevo ID de la banda del álbum"
}
```
### GET /banda

Obtiene una lista de todas las bandas.

**Parámetros de consulta:**

- `sortOrder`: Orden de los resultados ('ASC' o 'DESC').
- `sortField`: Campo por el cual ordenar los resultados.
- `filterField`: Campo por el cual filtrar los resultados.
- `filterValue`: Valor para el filtro.
- `resultLimit`: Cantidad máxima de resultados a retornar.
- `resultOffset`: Cantidad de resultados a omitir.

**Ejemplo de uso:**

```
http://localhost/TPE_3/banda?sortOrder=ASC&sortField=Nombre_banda&filterField=Banda_ID&filterValue=1&resultLimit=10&resultOffset=0
```

### POST /banda

Inserta una nueva banda.

**Cuerpo de la solicitud:**

- `Nombre_banda`: Nombre de la banda.
- `Fecha_Fundacion`: Fecha de fundación de la banda.

**Ejemplo de uso:**

```json
{
    "Nombre_banda": "Nombre de la nueva banda",
    "Fecha_Fundacion": "Fecha de fundación de la nueva banda"
}
```

### GET /banda/:ID

Obtiene una banda específica.

**Parámetros de ruta:**

- `ID`: ID de la banda.

**Ejemplo de uso:**

```
http://localhost/TPE_3/banda/{ID}
```

### DELETE /banda/:ID

Elimina una banda específica.

**Parámetros de ruta:**

- `ID`: ID de la banda.

**Ejemplo de uso:**

```
http://localhost/TPE_3/banda/{ID}
```

### PUT /banda/:ID

Actualiza una banda específica.

**Parámetros de ruta:**

- `ID`: ID de la banda.

**Cuerpo de la solicitud:**

- `Nombre_banda`: Nuevo nombre de la banda.
- `Fecha_Fundacion`: Nueva fecha de fundación de la banda.

**Ejemplo de uso:**

```json
{
    "Nombre_banda": "Nuevo nombre de la banda",
    "Fecha_Fundacion": "Nueva fecha de fundación de la banda"
}
```
