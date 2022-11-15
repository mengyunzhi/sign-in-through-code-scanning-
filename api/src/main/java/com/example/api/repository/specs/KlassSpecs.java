package com.example.api.repository.specs;

import com.example.api.entity.Klass;
import org.springframework.data.jpa.domain.Specification;

public class KlassSpecs {
    public static Specification<Klass> containName(String name) {
        if (name != null) {
            return (Specification<Klass>) (root, criteriaQuery, criteriaBuilder) -> criteriaBuilder.like(root.get("name").as(String.class), String.format("%%%s%%", name));
        } else {
            return Specification.where(null);
        }
    }
}