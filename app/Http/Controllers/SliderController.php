<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //
    public function save(Request $request){

        $this->validate($request, [
            'description1'=>'required',
            'description2'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        //Nom avec Extension
        $nomAvecExt = $request->file('image')->getClientOriginalName();

        //Nom sans Extension
        $nomSansExt = pathinfo($nomAvecExt, PATHINFO_FILENAME);

        //Extension
        $ext = pathinfo($nomAvecExt, PATHINFO_EXTENSION);

        //Nouveau nom unique a mettre dans la BD
        $nouveauNom = $nomSansExt.'_'.time().'.'.$ext;

        //Uploader l'img
        $chemin = $request->file('image')->storeAs('public/sliders_img', $nouveauNom);

        //Traitement des infos
        $slider = new Slider;
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->image = $nouveauNom;
        $slider->save();
        return redirect('admin/sliders')->with('status', 'Votre slider a ete cree avec succes');


    }

    public function delslid($id){
        $slider = Slider::find($id);
        $slider->delete();
        Storage::delete("public/sliders_img/$slider->image");

        return back()->with("status", 'Votre slider a ete supprime avec succes.');
    }

    public function editslid($id)
    {
        $slider = Slider::find($id);

        return view('admin.editslider')->with('slider', $slider);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'description1'=>'required',
            'description2'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);



        $slider = Slider::find($id);
        $slider->description1 = $request->input("description1");
        $slider->description2 = $request->input('description2');
        if (($request->file('image'))){
            //Nom avec Extension
            $nomAvecExt = $request->file('image')->getClientOriginalName();

            //Nom sans Extension
            $nomSansExt = pathinfo($nomAvecExt, PATHINFO_FILENAME);

            //Extension
            $ext = pathinfo($nomAvecExt, PATHINFO_EXTENSION);

            //Nouveau nom unique a mettre dans la BD
            $nouveauNom = $nomSansExt.'_'.time().'.'.$ext;

            //Uploader l'img
            $chemin = $request->file('image')->storeAs('public/sliders_img', $nouveauNom);
            Storage::delete("public/sliders_img/$slider->image");
            $slider->image = $nouveauNom;
        }
        $slider->update();
        return redirect('admin/sliders')->with('status', 'Le slider a ete modifie avec success.');
    }

    public function unactivate($id) {
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->update();

        return back()->with("status", 'Modifier avec succes');
    }

    public function activate($id) {
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->save();

        return back()->with("status", 'Modifier avec succes');
    }
}
