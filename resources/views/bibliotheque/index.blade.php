@extends('layouts.app')
@section('content')
@if($documents->count())

<style>
<style>
    /* Style général pour la bibliothèque */
    .library-shelf {
        background: #f5e6d3;
        background-image: linear-gradient(to bottom, #d4b896 0%, #f5e6d3 10%, #f5e6d3 90%, #d4b896 100%);
        border-radius: 10px;
        padding: 40px 20px 60px;
        margin: 40px 0;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 15px solid #8b4513;
        border-top: none;
        border-bottom: 20px solid #654321;
    }

    .library-shelf::before {
        content: '';
        position: absolute;
        top: -15px;
        left: 0;
        right: 0;
        height: 15px;
        background: #8b4513;
        border-radius: 5px 5px 0 0;
    }

    .library-shelf::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 0;
        right: 0;
        height: 20px;
        background: #654321;
        border-radius: 0 0 5px 5px;
    }

    .books-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        align-items: flex-end;
        min-height: 300px;
    }

    /* Style des livres */
    .book {
        position: relative;
        width: 120px;
        height: 200px;
        perspective: 1000px;
        transition: transform 0.3s ease;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .book:hover {
        transform: translateY(-10px) scale(1.05);
        z-index: 10;
    }

    .book-cover {
        position: absolute;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transform-origin: left center;
        transition: transform 0.5s ease;
    }

    .book:hover .book-cover {
        transform: rotateY(-30deg);
    }

    .book-spine {
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
        background: linear-gradient(90deg, #1a1a1a 0%, #333 100%);
        transform: rotateY(0deg);
        border-radius: 3px 0 0 3px;
        box-shadow: -2px 0 5px rgba(0,0,0,0.3);
    }

    .book-front {
        position: absolute;
        left: 20px;
        top: 0;
        width: calc(100% - 20px);
        height: 100%;
        background: linear-gradient(45deg, #3D80DB 0%, #1B13AD 100%);
        border-radius: 0 5px 5px 0;
        padding: 15px 10px;
        box-shadow: 5px 0 15px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }

    .book-title {
        font-size: 14px;
        font-weight: bold;
        color: white;
        line-height: 1.3;
        text-align: center;
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        word-wrap: break-word;
        max-height: 100px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .book-author {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        margin-top: 10px;
        font-style: italic;
    }

    .book-bottom {
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 0;
        height: 8px;
        background: #2c62b0;
        border-radius: 0 0 5px 0;
    }

    .book-pages {
        position: absolute;
        right: 0;
        top: 5px;
        height: calc(100% - 10px);
        width: 10px;
        background: linear-gradient(to right, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
        border-left: 1px solid #adb5bd;
        border-radius: 0 5px 5px 0;
    }

    .book-download-btn {
        position: absolute;
        bottom: 15px;
        left: 25px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: #1B13AD;
        border: none;
        padding: 6px 10px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 2;
    }

    .book:hover .book-download-btn {
        opacity: 1;
        transform: translateY(0);
    }

    .book-download-btn:hover {
        background: white;
        color: #3D80DB;
        transform: scale(1.05);
    }

    /* Variations de couleur pour les livres */
    .book:nth-child(4n+1) .book-front {
        background: linear-gradient(45deg, #3D80DB 0%, #1B13AD 100%);
    }

    .book:nth-child(4n+2) .book-front {
        background: linear-gradient(45deg, #28a745 0%, #1e7e34 100%);
    }

    .book:nth-child(4n+3) .book-front {
        background: linear-gradient(45deg, #dc3545 0%, #bd2130 100%);
    }

    .book:nth-child(4n+4) .book-front {
        background: linear-gradient(45deg, #ffc107 0%, #d39e00 100%);
    }

    .book:nth-child(4n+1) .book-bottom {
        background: #2c62b0;
    }

    .book:nth-child(4n+2) .book-bottom {
        background: #1e7e34;
    }

    .book:nth-child(4n+3) .book-bottom {
        background: #bd2130;
    }

    .book:nth-child(4n+4) .book-bottom {
        background: #d39e00;
    }

    /* Style pour "Aucun document" */
    .no-documents {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
        font-size: 1.2rem;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        margin: 40px 0;
        border: 2px dashed #dee2e6;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .book {
            width: 100px;
            height: 180px;
        }
    }

    @media (max-width: 992px) {
        .book {
            width: 90px;
            height: 160px;
        }
        
        .book-title {
            font-size: 12px;
        }
        
        .book-author {
            font-size: 10px;
        }
        
        .book-download-btn {
            font-size: 10px;
            padding: 5px 8px;
        }
    }

    @media (max-width: 768px) {
        .library-shelf {
            padding: 30px 15px 50px;
            border-width: 10px;
            border-bottom-width: 15px;
        }
        
        .book {
            width: 80px;
            height: 140px;
        }
        
        .books-container {
            gap: 15px;
        }
        
        .book-title {
            font-size: 10px;
            max-height: 70px;
            -webkit-line-clamp: 2;
        }
        
        .book-author {
            font-size: 9px;
            margin-top: 5px;
        }
        
        .book-download-btn {
            font-size: 9px;
            padding: 4px 6px;
            left: 22px;
        }
    }

    @media (max-width: 480px) {
        .books-container {
            justify-content: space-around;
        }
        
        .book {
            width: 70px;
            height: 120px;
        }
        
        .book-spine {
            width: 15px;
        }
        
        .book-front {
            left: 15px;
            width: calc(100% - 15px);
        }
        
        .book-download-btn {
            left: 18px;
        }
    }
</style>
</style>

<!-- Ajouter un nouveau document si admin et professeur -->
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'professeur')
        <a href="{{ route('documents.create') }}" class="btn btn-primary">Ajouter nouveau document</a>
    @endif
    <div class="library-shelf">
        <div class="books-container">
            @foreach($documents as $doc)
                <div class="book">
                    <div class="book-cover">
                        <div class="book-spine"></div>
                        <div class="book-front">
                            <h4 class="book-title">{{ $doc->titre }}</h4>
                            <div class="book-author">
                                {{ $doc->auteur->name ?? '—' }}
                            </div>
                            <a href="{{ route('documents.download', $doc) }}">
                                Télécharger
                            </a>

                        </div>
                        <div class="book-pages"></div>
                        <div class="book-bottom"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="no-documents">
        <p>Aucun document disponible dans la bibliothèque.</p>
    </div>
@endif
@endsection