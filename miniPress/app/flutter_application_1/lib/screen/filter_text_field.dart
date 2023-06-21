import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../providers/article_provider.dart';

class FilterTextField extends StatelessWidget {
  const FilterTextField({super.key});

  @override
  Widget build(BuildContext context) {
    return Flexible(
        child: Container(
            width: 200,
            margin: const EdgeInsets.symmetric(horizontal: 16),
            padding: const EdgeInsets.only(left: 35.0),
            child: TextField(
              onChanged: (value) {
                Provider.of<ArticleProvider>(context, listen: false)
                .setFilterKeyword(value);
              },
              decoration: const InputDecoration(
                hintText: 'Filtrer par mot-clé',
                hintStyle: TextStyle(
                  color: Colors.white,
                  fontSize: 18,
                ),
              ),
              style: const TextStyle(
                color: Colors.white,
                fontSize: 18,
              ),
            )));
  }
}
