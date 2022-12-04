<?php

namespace App\Controllers\Book;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Books extends BaseController
{
  public function index()
  {
    $model = model("BooksModel");
    if ($this->request->getGet("active") != "2") {
      $state = 1;
    } else {
      $state = 2;
    }

    if ($this->request->getGet("q")) {
      $q = trim($this->request->getGet("q"));
      $books = $model->getBooksByName($q, $state)->paginate(config("G3stor")->regPerPage);
      $data["books"] = $books;
      $data["countBooks"] =  count($books);
      $data["query"] = $q;
      $data["pager"] = $model->pager;
    } else {
      $data["books"] =  $model->getBooks($state)->paginate(config("G3stor")->regPerPage);
      $data["countBooks"] = $model->countBooks($state)["contar_libros_activos($state)"];
      $data["query"] = "";
      $data["pager"] = $model->pager;
    }


    return view("book/list", $data);
  }


  public function create()
  {
    $model = model("EditorialsModel");


    return view('book/create', [
      "editorials" => $model->getEditorials(1)->get()->getResult()
    ]);
  }

  public function store()
  {
    if (!$this->validate([
      "name" => "required|max_length[200]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "edition" => "required|max_length[200]",
      "pages" => "required|integer|max_length[200]",
    ])) {
      return redirect()->back()->withInput()->with("msg", [
        "type" => "warning",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
    }

    $model = model("BooksModel");
    $model->save([
      "nombre" => trim($this->request->getVar("name")),
      "id_editorial" => trim($this->request->getVar("id_editorial")),
      "edicion" => trim($this->request->getVar("edition")),
      "paginas" => trim($this->request->getVar("pages")),
    ]);

    return redirect("books")->with("msg", [
      "type" => "success",
      "body" => "El libro fue agregado exitosamente"
    ]);
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
      "name" => "required|max_length[200]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "edition" => "required|max_length[10]",
      "pages" => "required|integer|max_length[5]",
      "state" => "required|integer|max_length[5]",
    ])) {
      return redirect()->back()->withInput()->with("msg", [
        "type" => "warning",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
    }

    $newIdBook = trim($this->request->getVar("id_book"));
    $newName = trim($this->request->getVar("name"));
    $newIdEditorial = trim($this->request->getVar("id_editorial"));
    $newEdition = trim($this->request->getVar("edition"));
    $newPages = trim($this->request->getVar("pages"));
    $newState = trim($this->request->getVar("state"));

    $model = model("BooksModel");

    $book = $model->find($newIdBook);

    if ($newName == $book->nombre && $newIdEditorial == $book->id_editorial && $newEdition == $book->edicion && $newPages == $book->paginas && $newState == $book->activo) {
      return redirect("books")->with("msg", [
        "type" => "secondary",
        "body" => "Sin cambios"
      ]);
    }

    $string = implode(',', $book->toRawArray());
    $book = explode(',', $string);
    $model->oldInfo = $book;


    $model->save([
      "id_libros" =>$newIdBook,
      "nombre" => $newName,
      "id_editorial" => $newIdEditorial,
      "edicion" => $newEdition,
      "paginas" => $newPages,
      "activo" => $newState,
    ]);

    return redirect("books")->with("msg", [
      "type" => "info",
      "body" => "El libro fue actualizado exitosamente"
    ]);
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
