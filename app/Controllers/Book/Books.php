<?php

namespace App\Controllers\Book;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Books extends BaseController
{
  public function index()
  {
    $model = model("BooksModel");

    $q = $this->request->getGet("q");

 

    if ($q or $q === "") {
      $field = trim($this->request->getGet("field"));
      $books = $model->getBooksBy($field, $q)->paginate(config("G3stor")->regPerPage);
      $data["books"] = $books;
      $data["countBooks"] =  count($books);
    } else {
      $data["books"] =  $model->getBooks()->paginate(config("G3stor")->regPerPage);
      $data["countBooks"] = $model->countBooks();
    };

    $data["query"] = $q ?? "";
    $data["pager"] = $model->pager;
    $data["fields"] = $model->getFields();

    return view("book/list", $data);
  }


  public function create()
  {
    $model = model("EditorialsModel");


    return view('book/create', [
      "editorials" => $model->where("estado", 1)->findAll()
    ]);
  }

  public function store()
  {
    if (!$this->validate([
      "name" => "required|max_length[200]",
      "isbn" => "required|max_length[15]|min_length[10]|is_unique[libros.isbn]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "edition" => "required|max_length[10]",
      "pages" => "required|integer|max_length[20]",
      "cost" => "required|integer|max_length[20]",
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }


    $model = model("BooksModel");
    $model->insertBook(
      trim($this->request->getVar("isbn")),
      trim($this->request->getVar("name")),
      trim($this->request->getVar("id_editorial")),
      trim($this->request->getVar("edition")),
      trim($this->request->getVar("pages")),
      trim($this->request->getVar("cost"))
    );

    session()->setFlashdata("status", "Libro agregado correctamente");
    return redirect("books")->with("status_icon", "success");
  }


  public function edit(string $id)
  {
    $model = model("BooksModel");
    if (!$book = $model->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $eModel = model("EditorialsModel");

    return view("book/edit", [
      "book" => $book,
      "editorials" => $eModel->where("estado", 1)->findAll()
    ]);
  }


  public function update()
  {

    if (!$this->validate([
      "id_book" => "required|is_not_unique[libros.id_libros]",
      "isbn" => "required",
      "name" => "required|max_length[200]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "edition" => "required|max_length[10]",
      "pages" => "required|integer|max_length[5]",
      "cost" => "required|integer|max_length[20]",
      "state" => "required|integer|max_length[5]",
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $newIdBook = trim($this->request->getVar("id_book"));
    $newIsbn = trim($this->request->getVar("isbn"));
    $newName = trim($this->request->getVar("name"));
    $newIdEditorial = trim($this->request->getVar("id_editorial"));
    $newEdition = trim($this->request->getVar("edition"));
    $newPages = trim($this->request->getVar("pages"));
    $newCost = trim($this->request->getVar("cost"));
    $newState = trim($this->request->getVar("state"));

    $model = model("BooksModel");

    $book = $model->find($newIdBook);

    if ($newName == $book->nombre && $newIdEditorial == $book->id_editorial && $newEdition == $book->edicion && $newPages == $book->paginas && $newIsbn == $book->isbn && $newCost == $book->costo && $newState == $book->activo) {
      session()->setFlashdata("status", "No se realizarón cambios");
      return redirect("books")->with("status_icon", "info");
    }

    if ($newIsbn !== $book->isbn) {
      if (!$this->validate([
        "isbn" => "is_unique[libros.isbn]",
      ])) {
        session()->setFlashdata("status_text", "El ISBN ingresado ya esta registrado por otro libro");
        return redirect()->back()->withInput()->with("status_icon", "error")
          ->with("status", 'Disculpe, El ISBN "' . $newIsbn . '" ya existe')->with("errors", $this->validator->getErrors());
      }
    }

    $string = implode(',', $book->toRawArray());
    $book = explode(',', $string);
    $model->oldInfo = $book;


    $model->save([
      "id_libros" => $newIdBook,
      "isbn" => $newIsbn,
      "nombre" => $newName,
      "id_editorial" => $newIdEditorial,
      "edicion" => $newEdition,
      "paginas" => $newPages,
      "costo" => $newCost,
      "activo" => $newState,
    ]);

    session()->setFlashdata("status", "Libro actualizada correctamente");
    return redirect("books")->with("status_icon", "success");
  }


  public function delete(string $id)
  {
    $model = model("BooksModel");
    $book = $model->find($id);
    $string = implode(',', $book->toRawArray());
    $book = explode(',', $string);
    $model->oldInfo = $book;


    $model->deleteBook($id);

    return redirect("books")->with("msg", [
      "type" => "danger",
      "body" => "La editorial fue eliminada"
    ]);
  }
}
