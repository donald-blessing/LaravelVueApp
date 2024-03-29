<?php

namespace App\Models;

use App\Models\Classes;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'class_id',
        'section_id',
        'name',
        'email',
        'address',
        'phone_number',
    ];

    /**
     * Get the class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Get the class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('address', 'like', $term)
                ->orWhere('phone_number', 'like', $term)
                ->orWhereHas('class', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                })
                ->orWhereHas('section', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }

    public function scopeStudentsQuery($query)
    {
        $search_term = request('q', '');

        $selectedClass = request('selectedClass');
        $selectedSection = request('selectedSection');

        $sort_direction = request('sort_direction', 'desc');

        if (!in_array($sort_direction, ['asc', 'desc'])) {
            $sort_direction = 'desc';
        }

        $sort_field = request('sort_field', 'created_at');
        if (!in_array($sort_field, ['name', 'email', 'address', 'phone_number', 'created_at'])) {
            $sort_field = 'created_at';
        }

        $query->with(['class', 'section'])
            ->when($selectedClass, function ($query) use ($selectedClass) {
                $query->where('class_id', $selectedClass);
            })
            ->when($selectedSection, function ($query) use ($selectedSection) {
                $query->where('section_id', $selectedSection);
            })
            ->orderBy($sort_field, $sort_direction)
            ->search(trim($search_term));
    }
}
