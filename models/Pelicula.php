<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $idpelicula
 * @property string|null $portada
 * @property string|null $titulo
 * @property string|null $sinopsis
 * @property int|null $anio
 * @property string|null $duracion
 * @property int $fk_iddirector
 *
 * @property ActorHasPelicula[] $actorHasPeliculas
 * @property Actor[] $fkIdactors
 * @property Director $fkIddirector
 * @property Genero[] $fkIdgeneros
 * @property PeliculaHasGenero[] $peliculaHasGeneros
 */
class Pelicula extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelicula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portada', 'titulo', 'sinopsis', 'anio', 'duracion'], 'default', 'value' => null],
            [['anio', 'fk_iddirector'], 'integer'],
            [['duracion'], 'safe'],
            [['fk_iddirector'], 'required'],
            [[ 'titulo'], 'string', 'max' => 100],
            [['portada', 'titulo', 'sinopsis'], 'string', 'max' => 255],
            [['fk_iddirector'], 'exist', 'skipOnError' => true, 'targetClass' => Director::class, 'targetAttribute' => ['fk_iddirector' => 'iddirector']],
            [['imageFile'],'file','skipOnEmpty' => true,'extensions'=> 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpelicula' => Yii::t('app', 'Idpelicula'),
            'portada' => Yii::t('app', 'Portada'),
            'titulo' => Yii::t('app', 'Titulo'),
            'sinopsis' => Yii::t('app', 'Sinopsis'),
            'anio' => Yii::t('app', 'Año'),
            'duracion' => Yii::t('app', 'Duracion'),
            'fk_iddirector' => Yii::t('app', 'Director'),
        ];
    }

    public function upload(){
        if($this->validate()){
            if($this->isNewRecord){
                if(!$this->save(false)){
                    return false;
                }
            }
            if($this->imageFile instanceof UploadedFile){
            $filename = $this->idpelicula . '.' . $this->anio . '_movie_' . date('Ymd_His') . '.'. $this->imageFile->extension;
            $path = Yii::getAlias('@webroot/portadas/') . $filename;

            if($this->imageFile->saveAs($path)){
                if($this->portada && $this->portada !== $filename){
                    $this->deletePortada();
                }
                $this->portada = $filename;
                
            }
        }
        return $this->save(false);

        }
        
        return false;
    }

    public function deletePortada(){
        $path = Yii::getAlias('@webroot/portadas/') . $this->portada;
        if(file_exists($path)){

            unlink($path);
        }

    }

    /**
     * Gets query for [[ActorHasPeliculas]].
     *
     * @return \yii\db\ActiveQuery|ActorHasPeliculaQuery
     */
    public function getActorHasPeliculas()
    {
        return $this->hasMany(ActorHasPelicula::class, ['fk_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[FkIdactors]].
     *
     * @return \yii\db\ActiveQuery|ActorQuery
     */
    public function getFkIdactors()
    {
        return $this->hasMany(Actor::class, ['idactor' => 'fk_idactor'])->viaTable('actor_has_pelicula', ['fk_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[FkIddirector]].
     *
     * @return \yii\db\ActiveQuery|DirectorQuery
     */
    public function getFkIddirector()
    {
        return $this->hasOne(Director::class, ['iddirector' => 'fk_iddirector']);
    }

    /**
     * Gets query for [[FkIdgeneros]].
     *
     * @return \yii\db\ActiveQuery|GeneroQuery
     */
    public function getFkIdgeneros()
    {
        return $this->hasMany(Genero::class, ['idcategoria' => 'fk_idgenero'])->viaTable('pelicula_has_genero', ['fk_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[PeliculaHasGeneros]].
     *
     * @return \yii\db\ActiveQuery|PeliculaHasGeneroQuery
     */
    public function getPeliculaHasGeneros()
    {
        return $this->hasMany(PeliculaHasGenero::class, ['fk_idpelicula' => 'idpelicula']);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeliculaQuery(get_called_class());
    }

}
