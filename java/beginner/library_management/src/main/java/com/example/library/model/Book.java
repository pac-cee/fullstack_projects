package com.example.library.model;

import lombok.Data;
import javax.persistence.*;
import javax.validation.constraints.NotBlank;
import java.util.HashSet;
import java.util.Set;

@Data
@Entity
@Table(name = "books")
public class Book {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @NotBlank
    @Column(unique = true)
    private String isbn;

    @NotBlank
    private String title;

    @NotBlank
    private String author;

    private String description;

    @ManyToOne
    @JoinColumn(name = "category_id")
    private Category category;

    private int totalCopies;
    private int availableCopies;

    @OneToMany(mappedBy = "book")
    private Set<LendingRecord> lendingRecords = new HashSet<>();
} 