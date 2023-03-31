# Web-de-Libros_MTK
Pequeña pagina web con el CRUD para un catalogo de libros, en el que se pueden agregar imagenes para cada libro.

[Universidad Politécnica de Durango](http://www.unipolidgo.edu.mx/sitio/) - Ingeniería en software 8°A
- [Francisco Javier Rivera](https://github.com/MierderTheKat)

## Base de datos utilizada

Nombre de la base de datos: `imagenes`

Nombre de la tabla: `libros`

Estructura:
| #     | Nombre       | Tipo        | extra          |
| :---: | :---         | :---        | :---           |
| 1     | `idPrimaria` | int(9)      | AUTO_INCREMENT |
| 2     | `titulo`     | varchar(50) |                |
| 3     | `autor`      | varchar(50) |                |
| 4     | `imagen`     | longblob    |                |
